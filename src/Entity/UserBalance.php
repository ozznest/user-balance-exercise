<?php


namespace User\Balance\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User.
 * @ORM\Entity()
 * @ORM\Table(name="user_balance")
 * @ORM\Entity(repositoryClass="User\Balance\Repository\BalanceRepository")
 */
class UserBalance
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float|null
     *
     * @ORM\Column(name="balance", type="float", precision=11, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $balance = 0.00;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User\Balance\Entity\User")
     * @ORM\JoinColumn(name="usr_id", referencedColumnName="id")
     */
    private $user;

    /** @ORM\Version
     *  @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @return float|null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @param float|null $balance
     */
    public function setBalance(?float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }


}
