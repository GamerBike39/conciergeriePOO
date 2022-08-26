<?php

namespace App\Models;

class TachesModel extends Model{

    protected $id;
    protected $date;
    protected $type_tache;
    protected $desc_tache;
    protected $appart;
    protected $etage;
    protected $resident_id;


    public function __construct(){

        $this->table = 'taches';
    }



    /**
     * Get the value of resident_id
     */ 
    public function getResident_id()
    {
        return $this->resident_id;
    }

    /**
     * Set the value of resident_id
     *
     * @return  self
     */ 
    public function setResident_id($resident_id)
    {
        $this->resident_id = $resident_id;

        return $this;
    }

    /**
     * Get the value of etage
     */ 
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set the value of etage
     *
     * @return  self
     */ 
    public function setEtage($etage)
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * Get the value of appart
     */ 
    public function getAppart()
    {
        return $this->appart;
    }

    /**
     * Set the value of appart
     *
     * @return  self
     */ 
    public function setAppart($appart)
    {
        $this->appart = $appart;

        return $this;
    }

    /**
     * Get the value of desc_tache
     */ 
    public function getDesc_tache()
    {
        return $this->desc_tache;
    }

    /**
     * Set the value of desc_tache
     *
     * @return  self
     */ 
    public function setDesc_tache($desc_tache)
    {
        $this->desc_tache = $desc_tache;

        return $this;
    }

    /**
     * Get the value of type_tache
     */ 
    public function getType_tache()
    {
        return $this->type_tache;
    }

    /**
     * Set the value of type_tache
     *
     * @return  self
     */ 
    public function setType_tache($type_tache)
    {
        $this->type_tache = $type_tache;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    }