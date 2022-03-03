<?php

// $ docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php iterator.php

class Profile {
    public int $profileId;
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }
}

// interface comum a todos iteradores.
interface ProfileIterator {
    public function getNext(): Profile;
    public function hasMore(): bool;
}

// fábrica para iteradores
interface SocialNetwork {
    public function createFriendsIterator($profileId): ProfileIterator;
    public function createCoworkersIterator($profileId): ProfileIterator;
}

// classe iterador concreta
class FacebookIterator implements ProfileIterator
{
    private Facebook $facebook;
    private int $profileId;
    private string $type;

    private int $currentPosition;
    /** @var Profile[] */
    private array $cache;

    public function __construct($facebook, $profileId, $type)
    {
        $this->facebook = $facebook;
        $this->profileId = $profileId;
        $this->type = $type;
    }

    private function lazyInit() {
        if (empty($this->cache)) {
            $this->cache = $this->facebook->socialGraphRequest($this->profileId, $this->type);
        }
    }

    public function getNext(): Profile
    {
        if ($this->hasMore()) {
            $this->currentPosition++;
        }
        return $this->cache[$this->currentPosition];
    }

    public function hasMore(): bool
    {
        $this->lazyInit();
        return $this->currentPosition < count($this->cache);
    }
}

class Facebook implements SocialNetwork {

    public function socialGraphRequest($profileId, $type): array
    {
        return [];
    }

    public function createFriendsIterator($profileId): ProfileIterator
    {
        return new FacebookIterator($this, $profileId, "friends");
    }

    public function createCoworkersIterator($profileId): ProfileIterator
    {
        return new FacebookIterator($this, $profileId, "coworkers");
    }
}


// Aqui temos outro truque útil: você pode passar um iterador
// para uma classe cliente ao invés de dar acesso a ela à uma
// coleção completa. Dessa forma, você não expõe a coleção ao
// cliente.
//
// E tem outro benefício: você pode mudar o modo que o cliente
// trabalha com a coleção no tempo de execução ao passar a ele
// um iterador diferente. Isso é possível porque o código
// cliente não é acoplado às classes iterador concretas.
class SocialSpammer
{
    public function send(ProfileIterator $iterator, string $message)
    {
        while ($iterator->hasMore()) {
            $profile = $iterator->getNext();
            mail($profile->getEmail(), 'Spam', $message);
        }
    }

}


class IteratorApplication {
    public SocialNetwork $network;
    public SocialSpammer $spammer;

    public function config()
    {
        // se Facebook
        $this->network = new Facebook();
        // se LinkedIn
        // $this->network = new LinkedIn();
        $this->spammer = new SocialSpammer();
    }

    public function sendSpamToFriends(Profile $profile)
    {
        $iterator = $this->network->createFriendsIterator($profile->profileId);
        $this->spammer->send($iterator, "Chegou spam galere!");
    }

    public function sendSpamToCoworkers(Profile $profile)
    {
        $iterator = $this->network->createCoworkersIterator($profile->profileId);
        $this->spammer->send($iterator, "Spam pro trabalho.");
    }
}

$app = new IteratorApplication();
$app->config();
$app->sendSpamToFriends(new Profile());


//
//Trecho de
//Mergulho nos Padrões de Projeto
//Alexander Shvets
//Este material pode estar protegido por copyright.