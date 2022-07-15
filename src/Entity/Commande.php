<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
 use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ApiResource(
    // attributes: ["security" => "is_granted('ROLE_USER')"],
    collectionOperations: [
        "post" => [
            // "security" => "is_granted('ROLE_CLIENT')",
            "security_message" => "uniquement pour client",
            'denormalization_context' => ["groups" => ["com:details"]],
            "normalization_context" => ["groups" => ["com:details:all"]]
        ],
    ],
    itemOperations: [
        "get" => [
            "security" => "is_granted('ROLE_GESTIONNAIRE')",
            "security_message" => "uniquement pour gestionnaire",
    ],
        "put" => [
            "security_post_denormalize" => "is_granted('ROLE_GESTIONNAIRE')",
            "security_post_denormalize_message" => "Sorry, but you are not the actual book owner.",
        ],
    ],
    )]
#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

     #[ORM\Column(type: 'integer',nullable: true)]
     private $numCommande;

    #[ORM\Column(type: 'date',nullable: true)]
    private $date;

    #[ORM\Column(type: 'integer',nullable: true)]
    private $montant;

    #[ORM\Column(type: 'string', length: 255)]
    private $etat;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    private $client;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[Groups(['com:details:all', 'com:details'])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandePortionFrite::class,cascade:["persist"])]
    private $commandePortionFrites;

    #[Groups(['com:details:all', 'com:details'])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeTaille::class,cascade:["persist"])]
    private $commandeTailles;

    #[Groups(['com:details:all', 'com:details'])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeBurger::class,cascade:["persist"])]
    private $commandeBurgers;

    #[Groups(['com:details:all', 'com:details'])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeMenu::class,cascade:["persist"])]
    private $commandeMenus;

  
    public function __construct()
    {
        $this->etat="encours";
        $this->commandePortionFrites = new ArrayCollection();
        $this->commandeTailles = new ArrayCollection();
        $this->commandeBurgers = new ArrayCollection();
        $this->commandeMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCommande(): ?int
    {
        return $this->numCommande;
    }

    public function setNumCommande(int $numCommande): self
    {
        $this->numCommande = $numCommande;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

  
    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    /**
     * @return Collection<int, CommandePortionFrite>
     */
    public function getCommandePortionFrites(): Collection
    {
        return $this->commandePortionFrites;
    }

    public function addCommandePortionFrite(CommandePortionFrite $commandePortionFrite): self
    {
        if (!$this->commandePortionFrites->contains($commandePortionFrite)) {
            $this->commandePortionFrites[] = $commandePortionFrite;
            $commandePortionFrite->setCommande($this);
        }

        return $this;
    }

    public function removeCommandePortionFrite(CommandePortionFrite $commandePortionFrite): self
    {
        if ($this->commandePortionFrites->removeElement($commandePortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($commandePortionFrite->getCommande() === $this) {
                $commandePortionFrite->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeTaille>
     */
    public function getCommandeTailles(): Collection
    {
        return $this->commandeTailles;
    }

    public function addCommandeTaille(CommandeTaille $commandeTaille): self
    {
        if (!$this->commandeTailles->contains($commandeTaille)) {
            $this->commandeTailles[] = $commandeTaille;
            $commandeTaille->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeTaille(CommandeTaille $commandeTaille): self
    {
        if ($this->commandeTailles->removeElement($commandeTaille)) {
            // set the owning side to null (unless already changed)
            if ($commandeTaille->getCommande() === $this) {
                $commandeTaille->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeBurger>
     */
    public function getCommandeBurgers(): Collection
    {
        return $this->commandeBurgers;
    }

    public function addCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if (!$this->commandeBurgers->contains($commandeBurger)) {
            $this->commandeBurgers[] = $commandeBurger;
            $commandeBurger->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if ($this->commandeBurgers->removeElement($commandeBurger)) {
            // set the owning side to null (unless already changed)
            if ($commandeBurger->getCommande() === $this) {
                $commandeBurger->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeMenu>
     */
    public function getCommandeMenus(): Collection
    {
        return $this->commandeMenus;
    }

    public function addCommandeMenu(CommandeMenu $commandeMenu): self
    {
        if (!$this->commandeMenus->contains($commandeMenu)) {
            $this->commandeMenus[] = $commandeMenu;
            $commandeMenu->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeMenu(CommandeMenu $commandeMenu): self
    {
        if ($this->commandeMenus->removeElement($commandeMenu)) {
            // set the owning side to null (unless already changed)
            if ($commandeMenu->getCommande() === $this) {
                $commandeMenu->setCommande(null);
            }
        }

        return $this;
    }

}
