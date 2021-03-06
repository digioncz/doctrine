<?php

declare(strict_types=1);

namespace Baraja\Doctrine\Entity;


use Baraja\Doctrine\UUID\UuidIdentifier;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Nette\SmartObject;
use Nette\Utils\DateTime;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *    name="core__database_slow_query",
 *    indexes={
 *       @Index(name="database_slow_query__hash", columns={"hash"}),
 *       @Index(name="database_slow_query__id_hash", columns={"id", "hash"})
 *    }
 * )
 */
class SlowQuery
{
	use UuidIdentifier;
	use SmartObject;

	/** @ORM\Column(type="text") */
	private string $query;

	/** @ORM\Column(type="float") */
	private float $duration;

	/** @ORM\Column(type="string", length=32, unique=true) */
	private string $hash;

	/** @ORM\Column(type="datetime") */
	private \DateTime $insertedDate;


	public function __construct(string $sql, string $hash, float $duration)
	{
		$this->query = $sql;
		$this->duration = $duration;
		$this->hash = $hash;
		$this->insertedDate = DateTime::from('now');
	}


	public function getQuery(): string
	{
		return $this->query;
	}


	public function getDuration(): float
	{
		return $this->duration;
	}


	public function getHash(): string
	{
		return $this->hash;
	}


	public function getInsertedDate(): \DateTime
	{
		return $this->insertedDate;
	}
}
