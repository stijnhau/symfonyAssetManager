<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use \app\Entity\AssetType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="assets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

    /**
     * @ORM\ManyToMany(targetEntity="\App\Entity\AssetType", inversedBy="assets")
     */
    private $asset_type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MarketingType", inversedBy="assets")
     */
    private $marketing_type;

    public function __construct()
    {
        $this->asset_type = new ArrayCollection();
        $this->marketing_type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection|AssetType[]
     */
    public function getAssetType(): Collection
    {
        return $this->asset_type;
    }

    public function addAssetType(AssetType $assetType): self
    {
        if (!$this->asset_type->contains($assetType)) {
            $this->asset_type[] = $assetType;
        }

        return $this;
    }

    public function removeAssetType(AssetType $assetType): self
    {
        if ($this->asset_type->contains($assetType)) {
            $this->asset_type->removeElement($assetType);
        }

        return $this;
    }

    /**
     * @return Collection|MarketingType[]
     */
    public function getMarketingType(): Collection
    {
        return $this->marketing_type;
    }

    public function addMarketingType(MarketingType $marketingType): self
    {
        if (!$this->marketing_type->contains($marketingType)) {
            $this->marketing_type[] = $marketingType;
        }

        return $this;
    }

    public function removeMarketingType(MarketingType $marketingType): self
    {
        if ($this->marketing_type->contains($marketingType)) {
            $this->marketing_type->removeElement($marketingType);
        }

        return $this;
    }
}
