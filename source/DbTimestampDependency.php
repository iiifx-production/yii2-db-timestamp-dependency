<?php

namespace iiifx\caching\extra;

use Yii;
use yii\caching\DbDependency;

class DbTimestampDependency extends DbDependency {

    /**
     * Название таблицы или список названий таблиц, которые будут проверяться
     *
     * @var string|array
     */
    public $table;

    /**
     * Название поля или список названий полей, который будут проверяться
     *
     * @var string|array
     */
    public $timestamp = [ 'date_created', 'date_edited' ];

    protected $tableList = [];

    protected $fieldList = [];

    protected $queryParts = [];

    public function init () {
        parent::init();
        $this->sql = $this->createSql();
    }

    public function createSql () {
        if ( $this->table && $this->timestamp ) {
            $this->table = (array) $this->table;
            $this->timestamp = (array) $this->timestamp;
            foreach ( $this->table as $tableName ) {
                $tableName = Yii::$app->db->getSchema()->getRawTableName( $tableName );
                $this->tableList[ $tableName ] = $tableName;
            }
            $this->queryParts[] = 'SELECT';
            foreach ( $this->tableList as $tableName ) {
                $this->queryParts[] = '( SELECT CONCAT( ';
                foreach ( $this->timestamp as $fieldName ) {
                    $this->queryParts[] = "MAX( {$tableName}.{$fieldName} ),";
                }
                $this->removeLastPartComma( $this->queryParts );
                $this->queryParts[] = ") FROM {$tableName} ) {$tableName},";
            }
            $this->removeLastPartComma( $this->queryParts );
            return implode( '', $this->queryParts );
        }
        return NULL;
    }

    protected function removeLastPartComma ( &$pasrtList ) {
        $lastIndex = count( $pasrtList ) - 1;
        $pasrtList[ $lastIndex ] = rtrim( $pasrtList[ $lastIndex ], ',' );
    }

}
