<?php

namespace local\app\Models\Books;

use Bitrix\Main\Entity\EntityError;
use Bitrix\Main\Entity\Event;
use Bitrix\Main\Entity\EventResult;
use Bitrix\Main\Entity\Query\Join;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\ORM\Fields\Validator\Base;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\ORM\Fields\Validators\RegExpValidator;


/**
 * Class Table
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> name string(50) optional
 * </ul>
 *
 * @package Bitrix\
 **/

class AuthorTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'authors';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new IntegerField(
                'id',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'title' => 'ENTITY_ID',
                ]
            ),
            new StringField(
                'name',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                    'title' => 'NAME',
                ]
            ),
            (new ManyToMany('BOOKS', BooksTable::class))
                ->configureTableName('book_author')
                ->configureLocalPrimary('ID', 'AUTHOR_ID')
                ->configureRemotePrimary('ID', 'BOOK_ID')
                ->configureTitle('BOOKS')
        ];
    }
}