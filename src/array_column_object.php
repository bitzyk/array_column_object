<?php
/** 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) 2013 Cristian Bitoi <http://www.linkedin.com/pub/cristian-bitoi/6a/125/2aa>
 * @license http://opensource.org/licenses/MIT MIT
 */

if (!function_exists('array_column_object')) {

    /**
     * Returns the values from a single propery of the input array of objects, identified by
     * the $propertyKey.
     *
     * Optionally, you may provide an $indexPropertyKey to index the values in the returned
     * array by the $indexPropertyKey property value.
     *
     * @param array $input An array of objects (record set).
     * @param mixed $propertyKey The property of values to return. This value may only be
     *                          a string, with name of property that you want to pull.
     * @param mixed $indexPropertyKey (Optional.) The property to use as the index/keys for
     *                        the returned array. This value may only be a string,
     *                        with name of property that you want to pull.
     * @return array
     */
    function array_column_object($input = null, $propertyKey = null, $indexPropertyKey = null)
    {

        if ( !$input ) {
            trigger_error("array_column_object() expects at least 2 parameters. Parameter 1:`input` was not been provided.", E_USER_WARNING);
            return null;
        }
        
        if ( !$propertyKey) {
            trigger_error("array_column_object() expects at least 2 parameters. Parameter 2:`columnKey` was not been provided.", E_USER_WARNING);
            return null;
        }
        

        if ( !is_array($input) ) {
            trigger_error('array_column_object() expects parameter 1:`input` to be array, ' . gettype($input) . ' given', E_USER_WARNING);
            return null;
        }
      
        if ( !is_string($propertyKey) 
             || is_numeric($propertyKey)   
        ) {
            trigger_error('array_column_object(): the parameter 2:`columnKey` should be a string non-numerical,' . gettype($propertyKey) . ' given', E_USER_WARNING);
            return false;
        }
        

        if ( isset($indexPropertyKey)
            && !is_string($indexPropertyKey)
            || is_numeric($indexPropertyKey)
        ) {
            trigger_error('array_column_object(): the parameter 3:`indexKey` should be a string non-numerical,' . gettype($indexPropertyKey) . ' given', E_USER_WARNING);
            return false;
        }
             
                
                        
        $resultArray = array();

        foreach ($input as $row) {
            
            if( !is_object($row) )
                continue;
            
            $key = $value = null;
            $keySet = $valueSet = false;

            if ( property_exists($row, $indexPropertyKey) ) {
                $keySet = true;
                $key = (string) $row->$indexPropertyKey;
            }

            if ( property_exists($row, $propertyKey) ) {
                $valueSet = true;
                $value = $row->$propertyKey;
            }

            if ( $valueSet ) {
                if ( $keySet ) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }

        }
        
        return $resultArray;
    }

}
