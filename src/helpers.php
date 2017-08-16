<?php

if (!function_exists('fluent_measure')) {

    /**
     * logs a measurement to fluentd
     * A Laravel helper
     * 
     * @param  string $event a measurement name like widgets.created
     * @param  array  $data  an array of numeric data.  All entries in this array must be an integer or float.
     * @param  array  $tags  an array of tags.  All tags are lookup fields such as userId or widgetType.
     * @param  int    $override_time The timestamp of the event. The default is the current time
     */
    function fluent_measure($event, $data=[], $tags=null, $override_time=null) {
        $logger = app('fluent.measurements');
        if (!$logger) { return; }

        $logger->log($event, $data, $tags, $override_time);
    }

}
