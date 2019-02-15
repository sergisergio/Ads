<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $names = [
            [ 'department' => '01 Ain'],
            [ 'department' => '02 Aisne'],
            [ 'department' => '03 Allier'],
            [ 'department' => '04 Alpes-de-Haute-Provence'],
            [ 'department' => '05 Hautes-Alpes'],
            [ 'department' => '06 Alpes-Maritimes'],
            [ 'department' => '07 Ardèche'],
            [ 'department' => '08 Ardennes'],
            [ 'department' => '09 Ariège'],
            [ 'department' => '10 Aube'],
            [ 'department' => '11 Aude'],
            [ 'department' => '12 Aveyron'],
            [ 'department' => '13 Bouches-du-Rhône'],
            [ 'department' => '14 Calvados'],
            [ 'department' => '15 Cantal'],
            [ 'department' => '16 Charente'],
            [ 'department' => '17 Charente-Maritime'],
            [ 'department' => '18 Cher'],
            [ 'department' => '19 Corrèze'],
            [ 'department' => '2A Corse-du-Sud'],
            [ 'department' => '2B Haute-Corse'],
            [ 'department' => '21 Côte-d\'Or'],
            [ 'department' => '22 Côtes d\'Armor'],
            [ 'department' => '23 Creuse'],
            [ 'department' => '24 Dordogne'],
            [ 'department' => '25 Doubs'],
            [ 'department' => '26 Drome'],
            [ 'department' => '27 Eure'],
            [ 'department' => '28 Eure-et-Loir'],
            [ 'department' => '29 Finistère'],
            [ 'department' => '30 Gard'],
            [ 'department' => '31 Haute-Garonne'],
            [ 'department' => '32 Gers'],
            [ 'department' => '33 Gironde'],
            [ 'department' => '34 Hérault'],
            [ 'department' => '35 Ille-et-Vilaine'],
            [ 'department' => '36 Indre'],
            [ 'department' => '37 Indre-et-Loire'],
            [ 'department' => '38 Isère'],
            [ 'department' => '39 Jura'],
            [ 'department' => '40 Landes'],
            [ 'department' => '41 Loir-et-Cher'],
            [ 'department' => '42 Loire'],
            [ 'department' => '43 Haute-Loire'],
            [ 'department' => '44 Loire-Atlantique'],
            [ 'department' => '45 Loiret'],
            [ 'department' => '46 Lot'],
            [ 'department' => '47 Lot-et-Garonne'],
            [ 'department' => '48 Lozère'],
            [ 'department' => '49 Maine-et-Loire'],
            [ 'department' => '50 Manche'],
            [ 'department' => '51 Marne'],
            [ 'department' => '52 Haute-Marne'],
            [ 'department' => '53 Mayenne'],
            [ 'department' => '54 Meurthe-et-Moselle'],
            [ 'department' => '55 Meuse'],
            [ 'department' => '56 Morbihan'],
            [ 'department' => '57 Moselle'],
            [ 'department' => '58 Nièvre'],
            [ 'department' => '59 Nord'],
            [ 'department' => '60 Oise'],
            [ 'department' => '61 Orne'],
            [ 'department' => '62 Pas-de-Calais'],
            [ 'department' => '63 Puy-de-Dôme'],
            [ 'department' => '64 Pyrénées-Atlantiques'],
            [ 'department' => '65 Hautes-Pyrénées'],
            [ 'department' => '66 Pyrénées-Orientales'],
            [ 'department' => '67 Bas-Rhin'],
            [ 'department' => '68 Haut-Rhin'],
            [ 'department' => '69 Rhône'],
            [ 'department' => '70 Haute-Saône'],
            [ 'department' => '71 Saône-et-Loire'],
            [ 'department' => '72 Sarthe'],
            [ 'department' => '73 Savoie'],
            [ 'department' => '74 Haute-Savoie'],
            [ 'department' => '75 Paris'],
            [ 'department' => '76 Seine-Maritime'],
            [ 'department' => '77 Seine-et-Marne'],
            [ 'department' => '78 Yvelines'],
            [ 'department' => '79 Deux-Sèvres'],
            [ 'department' => '80 Somme'],
            [ 'department' => '81 Tarn'],
            [ 'department' => '82 Tarn-et-Garonne'],
            [ 'department' => '83 Var'],
            [ 'department' => '84 Vaucluse'],
            [ 'department' => '85 Vendée'],
            [ 'department' => '86 Vienne'],
            [ 'department' => '87 Haute-Vienne'],
            [ 'department' => '88 Vosges'],
            [ 'department' => '89 Yonne'],
            [ 'department' => '90 Territoire de Belfort'],
            [ 'department' => '91 Essonne'],
            [ 'department' => '92 Hauts-de-Seine'],
            [ 'department' => '93 Seine-St-Denis'],
            [ 'department' => '94 Val-de-Marne'],
            [ 'department' => '95 Val-D\'Oise']
        ];

        foreach ($names as $name) {
            $department = new Department();
            $department->setName($name['department']);

            $manager->persist($department);
            $manager->flush();
        }

    }
}
