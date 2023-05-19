<?php

namespace App\Dtos;

class MunicipalitySearchDto
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $ibgeCode;

    public function setName(string $name): MunicipalitySearchDto
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $ibgeCode
     * @return $this
     */
    public function setIbgeCode(string $ibgeCode): MunicipalitySearchDto
    {
        $this->ibgeCode = $ibgeCode;
        return $this;
    }
}
