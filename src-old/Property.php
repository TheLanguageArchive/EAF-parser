<?php
namespace TLA\EAF;

/**
 * @author  Ibrahim Abdullah <ibrahim.abdullah@mpi.nl>
 * @package TLA EAF Parser
 */
class Property
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
     * serialize to array
     *
     * @return array
     */
    public function toArray()
    {
        return [

            'name'  => $this->getName(),
            'value' => $this->getValue(),
        ];
    }
}
