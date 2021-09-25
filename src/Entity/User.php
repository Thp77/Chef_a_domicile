<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\Interfaces\FilableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, FilableInterface
{
    public const FILE_DIR = '/upload/userpic';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="chief")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=Notice::class, mappedBy="consumer")
     */
    private $noticeConsumer;

    /**
     * @ORM\OneToMany(targetEntity=Notice::class, mappedBy="chief")
     */
    private $noticeChief;

    /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="chief", orphanRemoval=true)
     */
    private $menus;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->noticeConsumer = new ArrayCollection();
        $this->noticeChief = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFileDirectory(): string
    {
        return self::FILE_DIR;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setChief($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getChief() === $this) {
                $product->setChief(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Notice[]
     */
    public function getNoticeConsumer(): Collection
    {
        return $this->noticeConsumer;
    }

    public function addNoticeConsumer(Notice $noticeConsumer): self
    {
        if (!$this->noticeConsumer->contains($noticeConsumer)) {
            $this->noticeConsumer[] = $noticeConsumer;
            $noticeConsumer->setConsumer($this);
        }

        return $this;
    }

    public function removeNoticeConsumer(Notice $noticeConsumer): self
    {
        if ($this->noticeConsumer->removeElement($noticeConsumer)) {
            // set the owning side to null (unless already changed)
            if ($noticeConsumer->getConsumer() === $this) {
                $noticeConsumer->setConsumer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Notice[]
     */
    public function getNoticeChief(): Collection
    {
        return $this->noticeChief;
    }

    public function addNoticeChief(Notice $noticeChief): self
    {
        if (!$this->noticeChief->contains($noticeChief)) {
            $this->noticeChief[] = $noticeChief;
            $noticeChief->setChief($this);
        }

        return $this;
    }

    public function removeNoticeChief(Notice $noticeChief): self
    {
        if ($this->noticeChief->removeElement($noticeChief)) {
            // set the owning side to null (unless already changed)
            if ($noticeChief->getChief() === $this) {
                $noticeChief->setChief(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setChief($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getChief() === $this) {
                $menu->setChief(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
