<?php

namespace iiifx\cache\dependency;

use InvalidArgumentException;
use yii\caching\DbDependency;
use Yii;

class DbTimestampDependency extends DbDependency {

    public $options = [
        'fields' => [
            'count' => [ 'id' ],
            'max'   => [ 'date_created', 'date_edited' ],
        ]
    ];

    public $table;

    public $reusable = TRUE;

    public function init () {
        parent::init();
        $this->prepareOptions();
        $this->buildQuery();
    }

    protected function prepareOptions () {
        # Принудительно преобразуем в массивы
        if ( !is_array( $this->table ) ) {
            $this->table = (array) $this->table;
        }
        if ( isset( $this->options[ 'fields' ] ) ) {
            if ( isset( $this->options[ 'fields' ][ 'count' ] ) ) {
                if ( !is_array( $this->options[ 'fields' ][ 'count' ] ) ) {
                    $this->options[ 'fields' ][ 'count' ] = (array) $this->options[ 'fields' ][ 'count' ];
                }
            }
            if ( isset( $this->options[ 'fields' ][ 'max' ] ) ) {
                if ( !is_array( $this->options[ 'fields' ][ 'max' ] ) ) {
                    $this->options[ 'fields' ][ 'max' ] = (array) $this->options[ 'fields' ][ 'max' ];
                }
            }
        } else {
            # Опции должны быть указаны
            throw new InvalidArgumentException();
        }
    }

    protected function getCountFields () {
        if ( isset( $this->options[ 'fields' ][ 'count' ] ) ) {
            return $this->options[ 'fields' ][ 'count' ];
        }
        return [ ];
    }

    protected function getMaxFields () {
        if ( isset( $this->options[ 'fields' ][ 'max' ] ) ) {
            return $this->options[ 'fields' ][ 'max' ];
        }
        return [ ];
    }

    public function buildQuery () {
        if ( $this->table ) {
            $schema = Yii::$app->db->getSchema();
            $tableList = [ ];
            foreach ( $this->table as $tableName ) {
                $tableName = $schema->getRawTableName( $tableName );
                $tableList[ ] = $tableName;
            }
            $queryParts[ ] = 'SELECT';
            foreach ( $tableList as $tableName ) {
                $queryParts[ ] = '(SELECT CONCAT(';
                foreach ( $this->getMaxFields() as $fieldName ) {
                    $queryParts[ ] = "MAX(`{$tableName}`.`{$fieldName}`),";
                }
                $this->removeLastPartComma( $queryParts );
                foreach ( $this->getCountFields() as $fieldName ) {
                    $queryParts[ ] = "COUNT(`{$tableName}`.`{$fieldName}`),";
                }
                $this->removeLastPartComma( $queryParts );
                $queryParts[ ] = ") FROM `{$tableName}` ) `{$tableName}`,";
            }
            $this->removeLastPartComma( $queryParts );
            $this->sql = implode( '', $queryParts );
        }
    }

    protected function removeLastPartComma ( &$pasrtList ) {
        $lastIndex = count( $pasrtList ) - 1;
        $pasrtList[ $lastIndex ] = rtrim( $pasrtList[ $lastIndex ], ',' );
    }

}
