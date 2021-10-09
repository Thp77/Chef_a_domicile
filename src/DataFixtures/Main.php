<?php

namespace App\DataFixtures;

// use Faker;
use App\Entity\Menu;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Genre;
use DateTimeImmutable;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Main extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
       // $faker = Faker\Factory::create();

        $user = new User();
        $user->setUsername('thierry74')
            ->setEmail('thierrymalherbe@live.fr')
            ->setPassword($this->encoder->encodePassword($user, '0405DRAGan'))
            ->setRoles(['ROLE_ADMIN'])
            ->setFirstname('Thierry')
            ->setName('Malherbe')
            ->setPhone('0679451872')
            ->setBirthday(new DateTimeImmutable('1986-01-28')) 
            ;
        $manager->persist($user);
        $manager->flush();

        // for ($u = 0; $u < 6; $u++) {
        //     $user = new User();
        //     $user->setUsername($faker->userName)
        //     ->setEmail($faker->email)
        //     ->setPassword($this->encoder->encodePassword($user, '123456'))
        //     ->setRoles(['ROLE_USER'])
        //     ->setFirstname($faker->firstName($gender = null))
        //     ->setName($faker->lastName)
        //     ->setPhone($faker->phoneNumber)
        //     ->setBirthday(new DateTimeImmutable($faker->date($format = 'Y-m-d', $max = 'now')))
        //     ->setPhoto("https://picsum.photos/seed/". rand(0,5000) ."/800/400");
            
        //     $manager->persist($user);
        //     $manager->flush();
        // }
        
        // for ($u = 0; $u < 6; $u++) {
        //     $user = new User();
        //     $user->setUsername($faker->userName)
        //     ->setEmail($faker->email)
        //     ->setPassword($this->encoder->encodePassword($user, '123456'))
        //     ->setRoles(['ROLE_CHEF'])
        //     ->setFirstname($faker->firstName($gender = null))
        //     ->setName($faker->lastName)
        //     ->setPhone($faker->phoneNumber)
        //     ->setBirthday(new DateTimeImmutable($faker->date($format = 'Y-m-d', $max = 'now')))
        //     ->setPhoto("https://picsum.photos/seed/". rand(0,5000) ."/800/400");
            
        //     $manager->persist($user);
        //     $manager->flush();
        // }
        
        $type = new Type();
        $type->setType('Apéritif');
        $manager->persist($type);
        $manager->flush();

        $type = new Type();
        $type->setType('Entrée');
        $manager->persist($type);
        $manager->flush();

        $type = new Type();
        $type->setType('Plat principal');
        $manager->persist($type);
        $manager->flush();

        $type = new Type();
        $type->setType('Dessert');
        $manager->persist($type);
        $manager->flush();

        $genre = new Genre();
        $genre->setGenre('Convivial');
        $manager->persist($genre);
        $manager->flush();

        $genre = new Genre();
        $genre->setGenre('Tentation');
        $manager->persist($genre);
        $manager->flush();

        $genre = new Genre();
        $genre->setGenre('Épicure');
        $manager->persist($genre);
        $manager->flush();

        $genre = new Genre();
        $genre->setGenre('Signature');
        $manager->persist($genre);
        $manager->flush();

        // for ($p = 0; $p < 32; $p++) {
        //     $product = new Product();
        //     $product->setName($faker->words(4, true))
        //         ->setDescription($faker->realText(250,2))
        //         ->setPhoto("https://picsum.photos/seed/". rand(0,5000) ."/800/400")
        //         ->setType($manager->getRepository(Type::class)->find(rand(1,4)))
        //         ->setChief($manager->getRepository(User::class)->find(rand(8,13)));
        //     $manager->persist($product);
        //     $manager->flush();
        // }

        // for ($m = 0; $m < 8; $m++) {
        //     $menu = new Menu();
        //     $menu->setName($faker->words(4, true))
        //         ->setPrice(rand(20, 150))
        //         ->setGenre($manager->getRepository(Genre::class)->find(rand(1,4)))
        //         ->addProduct($manager->getRepository(Product::class)->find(rand(1,32)));            
        //     $manager->persist($menu);
        //     $manager->flush();
        // }

    }
}
