<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $release_in;

    /**
     * @ORM\Column(type="integer")
     */
    private $page_number;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    // private $brochureFilename;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $illustration;

    /**
     * @ORM\ManyToOne(targetEntity=Invoice::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Invoices;

    // Relations
    // --

    public function __construct()
    {
        $this->createAt = new \DateTime;
    }

    // public function getBrochureFilename()
    // {       
    //     return $this->brochureFilename;
    // }

    // public function setBrochureFilename($brochureFilename)
    // {
    //     $this->brochureFilename = $brochureFilename;
    //     return $this;
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReleaseIn(): ?string
    {
        return $this->release_in;
    }

    public function setReleaseIn(string $release_in): self
    {
        $this->release_in = $release_in;

        return $this;
    }

    public function getPageNumber(): ?int
    {
        return $this->page_number;
    }

    public function setPageNumber(int $page_number): self
    {
        $this->page_number = $page_number;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getIllustration()
    {
        return $this->illustration;
    }

    public function setIllustration( $illustration)
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function getInvoices(): ?Invoice
    {
        return $this->Invoices;
    }

    public function setInvoices(?Invoice $Invoices): self
    {
        $this->Invoices = $Invoices;

        return $this;
    }
}
