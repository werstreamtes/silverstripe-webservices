<?php
/**
 *
 *
 * @author <marcus@silverstripe.com.au>
 * @license BSD License http://www.silverstripe.org/bsd-license
 */

namespace nyeholt {

    class DataObjectSetXmlConverter
    {

        public function convert($set)
        {
            $items = array();

            foreach ($set as $item) {
                if ($item->hasMethod('toFilteredMap')) { // @SS4 $item instanceof SS_Object
                    $items[] = $item->toFilteredMap();
                } else if (method_exists($item, 'toMap')) {
                    $items[] = $item->toMap();
                } else {
                    $items[] = $item;
                }
            }

            $converter = new ArrayToXml('items');
            return $converter->convertArray($items);
        }

    }

}
