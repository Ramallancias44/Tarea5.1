<?php

namespace App\OptionsResolver;

use Symfony\Component\OptionsResolver\OptionsResolver;

class JugadorOptionsResolver extends OptionsResolver
{
  public function configureNombre(bool $isRequired = true): self
  {
    $this->setDefined("nombre")->setAllowedTypes("nombre", "string");

    if ($isRequired) {
      $this->setRequired("nombre");
    }

    $this->setDefined("altura")->setAllowedTypes("altura", "float");

    if ($isRequired) {
      $this->setRequired("altura");
    }
    $this->setDefined("dorsal")->setAllowedTypes("dorsal", "int");

    if ($isRequired) {
      $this->setRequired("dorsal");
    }

    return $this;
  }
  public function configureAltura(bool $isRequired = true): self
  {
    $this->setDefined("altura")->setAllowedTypes("altura", "float");

    if ($isRequired) {
      $this->setRequired("altura");
    }
    return $this;
  }
    public function configureDorsal(bool $isRequired = true): self
  {
    $this->setDefined("dorsal")->setAllowedTypes("dorsal", "int");

    if ($isRequired) {
      $this->setRequired("dorsal");
    }
    return $this;
  }

}
