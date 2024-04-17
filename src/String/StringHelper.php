<?php
namespace Strivex\Commons\String;

class StringHelper {
    
    ////////////////////
    // PUBLIC METHODS
    ////////////////////
    
    public function toLowerCase($string) {
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($string, 'UTF-8');
        } else {
            return strtolower($string);
        }
    }
    
    public function toUpperCase($string) {
        if (function_exists('mb_strtoupper')) {
            return mb_strtoupper($string, 'UTF-8');
        } else {
            return strtoupper($string);
        }
    }
    
    public function toPascalCase($string, $leaveSlashes, $delimiter="/") {
        
        $result = '';
        $string = trim($string, ' _-/\\');
        if (strpos($string, $delimiter)) {
            $segments = explode($delimiter, $string);
            foreach ($segments as $segment) {
                $subsegments = preg_split("/[ _-]/", $segment);
                foreach ($subsegments as $subsegment) {
                    $result .= ucfirst($subsegment);
                }
                if ($leaveSlashes) {
                    $result .= $delimiter;
                }
            }
            $result = trim($result, $delimiter);
        } else {
            $segments = preg_split("/[ _-]/", $string);
            foreach ($segments as $segment) {
                $result .= ucfirst($segment);
            }
        }
        
        return $result;
    }
    
    public function toCamelCase($string, $leaveSlashes, $delimiter="/") {
        
        $result = '';
        
        $string = trim($string, ' _-/\\');
        if (strpos($string, $delimiter)) {
            $segments = explode($delimiter, $string);
            foreach ($segments as $segment) {
                $subsegments = preg_split("/[ _-]/", $segment);
                if ($leaveSlashes) {
                    $result .= lcfirst(array_shift($subsegments));
                }
                foreach ($subsegments as $ix => $subsegment) {
                    $result .= ucfirst($subsegment);
                }
                if ($leaveSlashes) {
                    $result .= $delimiter;
                }
            }

            $result = lcfirst(trim($result, $delimiter));
        } else {
            $segments = preg_split("/[ _-]/", $string);
            foreach ($segments as $segment) {
                $result .= ucfirst($segment);
            }
        }
        
        return lcfirst($result);
    }
    
    public function toSnakeCase($string, $leaveSlashes, $delimiter="/") {
        return $this->_toSnakeOrKebabCase($string, $leaveSlashes, '_', $delimiter);
    }
    
    public function toKebabCase($string, $leaveSlashes, $delimiter="/") {
        return $this->_toSnakeOrKebabCase($string, $leaveSlashes, '-', $delimiter);
    }
    
    
    ////////////////////
    // PROTECTED METHODS
    ////////////////////
    protected function _toSnakeOrKebabCase($string, $leaveSlashes, $separator, $delimiter="/") {
        
        $result = '';

        // PascalCase input.
        $pascalcase = $this->toPascalCase($string, $leaveSlashes, $delimiter);

        if ($leaveSlashes) {
            $words = explode($delimiter, $pascalcase);
            
            foreach($words as $word) {
                $result .= $this->_baseSnakeOrKebab($word, $separator) . $delimiter;
            }

            $result = trim($result, $delimiter);
        } else {
            $result = $this->_baseSnakeOrKebab($pascalcase, $separator);
        }
        
        return $result;
    }
    
    
    ////////////////////
    // PRIVATE METHODS
    ////////////////////
    
    private function _baseSnakeOrKebab($string, $separator) {
        
        $v = preg_split('/([A-Z])/', $string, false, PREG_SPLIT_DELIM_CAPTURE);
        
        $a = array();
        array_shift($v);
        for ($i = 0; $i < count($v); ++$i) {
            if ($i % 2) {
                if (function_exists('mb_strtolower')) {
                    $a[] = mb_strtolower($v[$i - 1] . $v[$i], 'UTF-8');
                } else {
                    $a[] = strtolower($v[$i - 1] . $v[$i]);
                }
            }
        }
        
        return str_replace($separator.$separator, $separator, implode($separator, $a));
    }
}
