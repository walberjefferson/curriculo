<?php

namespace Authentication\Annotations\Mapping;

/**
 * Class ControllerAnnotation
 * @package Authentication\Annotations\Mapping
 * @Annotation
 * @Target("CLASS")
 */
class ControllerAnnotation
{
    public $name;
    public $description;
}
