<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\EmailValidationController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
// #[ApiResource(
//     collectionOperations:[
//         "post",
//         "post_register" => [
//         "method"=>"post",
//         'status' => Response::HTTP_CREATED,
//         'path'=>'register/',
//         'denormalization_context' => ['groups' => ['user:write']],
//         'normalization_context' => ['groups' => ['user:read:simple']]
//         ],
//         ]
// )]
#[ApiResource(
       collectionOperations:[
            "post",
            "VALIDATE" => [
            "method"=>"PATCH",
            'deserialize' => false,
            'path'=>'users/validate/{token}',
            'controller' => EmailValidationController::class
    
        ]]
     )]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read:simple'])]
    protected $id;

    #[Groups(['user:read:simple','user:write'])]
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    protected $email;
    
    #[ORM\Column(type: 'json')]
    #[Groups(['user:read:simple'])]
    protected $roles = [];

    #[ORM\Column(type: 'string')]
    protected $password;

    #[SerializedName("password")]
    protected $plainPassword;

    #[ORM\Column(type: 'boolean')]
     protected $isEnable=false;

    #[ORM\Column(type: 'string', length: 255)]
     protected $token;

    #[ORM\Column(type: 'datetime')]
     protected $expireAt;
public function __construct()
{
    $this->generateToken();
}
public function generateToken(){

    $this->token=str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(random_bytes(128)));
    $this->expireAt=new \DateTime("+1 day");


}
    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_VISITEUR';

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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function isIsEnable(): ?bool
    {
        return $this->isEnable;
    }

    public function setIsEnable(bool $isEnable): self
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getExpireAt(): ?\DateTimeInterface
    {
        return $this->expireAt;
    }

    public function setExpireAt(\DateTimeInterface $expireAt): self
    {
        $this->expireAt = $expireAt;

        return $this;
    }
}
