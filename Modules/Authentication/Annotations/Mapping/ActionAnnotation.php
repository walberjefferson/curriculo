<?php

namespace Authentication\Annotations\Mapping;


/**
 * Class ActionAnnotation
 * @package Authentication\Annotations\Mapping
 * @Annotation
 * @Target("METHOD")
 */
class ActionAnnotation
{
    public $name;
    public $description;
}
