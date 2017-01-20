<?php
/* ===========================================================================
 * Opis Project
 * http://opis.io
 * ===========================================================================
 * Copyright (c) 2013-2017 Opis Project
 *
 * Licensed under the MIT License
 * =========================================================================== */

namespace Opis\Closure;

/**
 * Serialize
 *
 * @param $data
 * @return string
 */
function serialize($data)
{
    static $counter = 0, $storage = null;

    if($counter++ === 0){
        $storage = new \SplObjectStorage();
    }

    SerializableClosure::wrapClosures($data, $storage);

    if(--$counter === 0){
        $storage = null;
    }

    return \serialize($data);
}

/**
 * Unserialize
 *
 * @param $data
 * @return mixed
 */
function unserialize($data)
{
    $data = \unserialize($data);
    SerializableClosure::unwrapClosures($data);
    return $data;
}