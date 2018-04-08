<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpeciesRepository")
 */
class Species
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomDeReference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $synonyme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomVernaculaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $regne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ordre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $famille;

    /**
     * @ORM\OneToMany(targetEntity="Observation", mappedBy="species")
     */
    private $observations;


    public function __construct()
    {
        $this->observations = new ArrayCollection();

    }

    /**
     * @param Observation $observation
     * @return $this
     */
    public function addObservation(\App\Entity\Observation $observation)
    {
        $this->observations[] = $observation;
        return $this;
    }

    /**
     * @param Observation $observation
     */
    public function removeObservation(\App\Entity\Observation $observation)
    {
        $this->observations->removeElement($observation);
    }

    /**
     * @return ArrayCollection
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomDeReference()
    {
        return $this->nomDeReference;
    }

    /**
     * @param mixed $nomDeReference
     */
    public function setNomDeReference($nomDeReference): void
    {
        $this->nomDeReference = $nomDeReference;
    }

    /**
     * @return mixed
     */
    public function getSynonyme()
    {
        return $this->synonyme;
    }

    /**
     * @param mixed $synonyme
     */
    public function setSynonyme($synonyme): void
    {
        $this->synonyme = $synonyme;
    }

    /**
     * @return mixed
     */
    public function getNomVernaculaire()
    {
        return $this->nomVernaculaire;
    }

    /**
     * @param mixed $nomVernaculaire
     */
    public function setNomVernaculaire($nomVernaculaire): void
    {
        $this->nomVernaculaire = $nomVernaculaire;
    }

    /**
     * @return mixed
     */
    public function getRegne()
    {
        return $this->regne;
    }

    /**
     * @param mixed $regne
     */
    public function setRegne($regne): void
    {
        $this->regne = $regne;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     */
    public function setClasse($classe): void
    {
        $this->classe = $classe;
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre): void
    {
        $this->ordre = $ordre;
    }

    /**
     * @return mixed
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * @param mixed $famille
     */
    public function setFamille($famille): void
    {
        $this->famille = $famille;
    }

    /**
     * @return mixed
     */
    public function getCDREF()
    {
        return $this->CD_REF;
    }

    /**
     * @param mixed $CD_REF
     */
    public function setCDREF($CD_REF): void
    {
        $this->CD_REF = $CD_REF;
    }

    /**
     * @return mixed
     */
    public function getCDNOM()
    {
        return $this->CD_NOM;
    }

    /**
     * @param mixed $CD_NOM
     */
    public function setCDNOM($CD_NOM): void
    {
        $this->CD_NOM = $CD_NOM;
    }


}
