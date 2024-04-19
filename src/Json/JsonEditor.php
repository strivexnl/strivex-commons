<?php

namespace Strivex\Commons\Json;

use Adbar\Dot;

class JsonEditor {
    
    const BUMPTYPE_MAJOR = 'major';
    const BUMPTYPE_MINOR = 'minor';
    const BUMPTYPE_PATCH = 'patch';
    const BUMPTYPE_ALPHA = 'alpha';
    const BUMPTYPE_BETA = 'beta';
    const BUMPTYPE_RC = 'RC';
    
    private $dot;
    private $filePath;
    
    ////////////////////
    /// CONSTRUCTOR
    ////////////////////
    public function __construct($filePath) {
        $this->dot = new Dot();
        $this->reload($filePath);
    }
    
    ////////////////////
    /// PUBLIC METHODS
    ////////////////////
    public function add($key, $value, $overwrite = false) {
        if ($overwrite) {
            $this->dot->set($key, $value);
        } else {
            $this->dot->add($key, $value);
        }
        return $this;
    }
    
    public function addMultiple($keyValues, $overwrite=false) {
        if ($overwrite) {
            $this->dot->set($keyValues);
        } else {
            $this->dot->set($keyValues);
        }
        return $this;
    }
    
    public function delete($key) {
        $this->dot->delete($key);
        return $this;
    }
    
    public function deleteMultiple($keys) {
        $this->dot->delete($keys);
        return $this;
    }
    
    public function get($key, $default = null) {
        return $this->dot->get($key, $default);
    }
    
    public function reload($filePath) {
        
        if (file_exists($filePath)) {
            $this->filePath = $filePath;
            $json           = file_get_contents($this->filePath);
            $data           = json_decode($json, true);
            $this->dot->setArray($data);
        } else {
            throw new \Exception(sprintf('%s does not exist.', $filePath));
        }
        return $this;
    }
    
    public function save() {
        file_put_contents($this->filePath, $this->toString(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),);
    }
    
    public function bumpVersion($path, $type, $startPreRelease = false, $overwrite = true) {
        $version = $this->get($path);
        $parts = preg_split('/-/', $version);
        [$major, $minor, $patch] = explode('.', $parts[0]) + [0,0,0];
        $preRelease = isset($parts[1]) ? $parts[1] : '';
        
        switch($type) {
            case 'major':
                $major++;
                $minor = 0;
                $patch = 0;
                $preRelease = $startPreRelease ? 'alpha.1' : '';
                break;
            case 'minor':
                $minor++;
                $patch = 0;
                $preRelease = $startPreRelease ? 'alpha.1' : '';
                break;
            case 'patch':
                $patch++;
                $preRelease = $startPreRelease ? 'alpha.1' : '';
                break;
            case 'alpha':
            case 'beta':
            case 'RC':
                if ($preRelease && strpos($preRelease, $type) === 0) {
                    $number = intval(substr($preRelease, strlen($type) + 1)) + 1;
                    $preRelease = $type . '.' . $number;
                } else {
                    $preRelease = $type . '.1';
                }
                break;
        }
        
        $newVersion = implode('.', [$major, $minor, $patch]);
        if ($preRelease !== '') {
            $newVersion .= '-' . $preRelease;
        }
        
        $this->add($path, $newVersion, $overwrite);
        
        return $this;
    }
    
    public function toString($flags = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) {
        $data = $this->dot->all();
        return json_encode($data, $flags);
    }
    
    public function toArray() {
        return $this->dot->all();
    }
}