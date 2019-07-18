<?php
namespace MPI\EAF;

use JsonSerializable;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package MPI EAF Parser
 */
class Property implements JsonSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    /**
     * Get name of property
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get value of property
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * json_encode calls this method
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [

            'name'  => $this->getName(),
            'value' => $this->getValue(),
        ];
    }
}
