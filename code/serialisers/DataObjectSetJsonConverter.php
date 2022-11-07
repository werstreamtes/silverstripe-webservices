<?php
/**
 * Used to convert a data object to a json object
 *
 * @author marcus@silverstripe.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */

namespace nyeholt {

    use SilverStripe\Core\Convert;
    use stdClass;

    class DataObjectSetJsonConverter
    {

        public function convert($set)
        {
            $ret = new stdClass();
            $ret->items = array();
            foreach ($set as $item) {
                if ($item->hasMethod('toFilteredMap')) { // @SS4 $item instanceof SS_Object
                    $ret->items[] = $item->toFilteredMap();
                } else if (method_exists($item, 'toMap')) {
                    $ret->items[] = $item->toMap();
                } else {
                    $ret->items[] = $item;
                }
            }

            return Convert::raw2json($ret);
        }

    }

}
