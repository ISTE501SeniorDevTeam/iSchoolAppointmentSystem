<?php

namespace Map;

use \Visit;
use \VisitQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'visit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class VisitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.VisitTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'visit';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Visit';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Visit';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'visit.id';

    /**
     * the column name for the advisor_id field
     */
    const COL_ADVISOR_ID = 'visit.advisor_id';

    /**
     * the column name for the student_id field
     */
    const COL_STUDENT_ID = 'visit.student_id';

    /**
     * the column name for the reason_id field
     */
    const COL_REASON_ID = 'visit.reason_id';

    /**
     * the column name for the modality_id field
     */
    const COL_MODALITY_ID = 'visit.modality_id';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'visit.created_at';

    /**
     * the column name for the invited_at field
     */
    const COL_INVITED_AT = 'visit.invited_at';

    /**
     * the column name for the complete_at field
     */
    const COL_COMPLETE_AT = 'visit.complete_at';

    /**
     * the column name for the position field
     */
    const COL_POSITION = 'visit.position';

    /**
     * the column name for the custom_reason field
     */
    const COL_CUSTOM_REASON = 'visit.custom_reason';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'AdvisorId', 'StudentId', 'ReasonId', 'ModalityId', 'CreatedAt', 'InvitedAt', 'CompleteAt', 'Position', 'CustomReason', ),
        self::TYPE_CAMELNAME     => array('id', 'advisorId', 'studentId', 'reasonId', 'modalityId', 'createdAt', 'invitedAt', 'completeAt', 'position', 'customReason', ),
        self::TYPE_COLNAME       => array(VisitTableMap::COL_ID, VisitTableMap::COL_ADVISOR_ID, VisitTableMap::COL_STUDENT_ID, VisitTableMap::COL_REASON_ID, VisitTableMap::COL_MODALITY_ID, VisitTableMap::COL_CREATED_AT, VisitTableMap::COL_INVITED_AT, VisitTableMap::COL_COMPLETE_AT, VisitTableMap::COL_POSITION, VisitTableMap::COL_CUSTOM_REASON, ),
        self::TYPE_FIELDNAME     => array('id', 'advisor_id', 'student_id', 'reason_id', 'modality_id', 'created_at', 'invited_at', 'complete_at', 'position', 'custom_reason', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AdvisorId' => 1, 'StudentId' => 2, 'ReasonId' => 3, 'ModalityId' => 4, 'CreatedAt' => 5, 'InvitedAt' => 6, 'CompleteAt' => 7, 'Position' => 8, 'CustomReason' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'advisorId' => 1, 'studentId' => 2, 'reasonId' => 3, 'modalityId' => 4, 'createdAt' => 5, 'invitedAt' => 6, 'completeAt' => 7, 'position' => 8, 'customReason' => 9, ),
        self::TYPE_COLNAME       => array(VisitTableMap::COL_ID => 0, VisitTableMap::COL_ADVISOR_ID => 1, VisitTableMap::COL_STUDENT_ID => 2, VisitTableMap::COL_REASON_ID => 3, VisitTableMap::COL_MODALITY_ID => 4, VisitTableMap::COL_CREATED_AT => 5, VisitTableMap::COL_INVITED_AT => 6, VisitTableMap::COL_COMPLETE_AT => 7, VisitTableMap::COL_POSITION => 8, VisitTableMap::COL_CUSTOM_REASON => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'advisor_id' => 1, 'student_id' => 2, 'reason_id' => 3, 'modality_id' => 4, 'created_at' => 5, 'invited_at' => 6, 'complete_at' => 7, 'position' => 8, 'custom_reason' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Visit.Id' => 'ID',
        'id' => 'ID',
        'visit.id' => 'ID',
        'VisitTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'AdvisorId' => 'ADVISOR_ID',
        'Visit.AdvisorId' => 'ADVISOR_ID',
        'advisorId' => 'ADVISOR_ID',
        'visit.advisorId' => 'ADVISOR_ID',
        'VisitTableMap::COL_ADVISOR_ID' => 'ADVISOR_ID',
        'COL_ADVISOR_ID' => 'ADVISOR_ID',
        'advisor_id' => 'ADVISOR_ID',
        'visit.advisor_id' => 'ADVISOR_ID',
        'StudentId' => 'STUDENT_ID',
        'Visit.StudentId' => 'STUDENT_ID',
        'studentId' => 'STUDENT_ID',
        'visit.studentId' => 'STUDENT_ID',
        'VisitTableMap::COL_STUDENT_ID' => 'STUDENT_ID',
        'COL_STUDENT_ID' => 'STUDENT_ID',
        'student_id' => 'STUDENT_ID',
        'visit.student_id' => 'STUDENT_ID',
        'ReasonId' => 'REASON_ID',
        'Visit.ReasonId' => 'REASON_ID',
        'reasonId' => 'REASON_ID',
        'visit.reasonId' => 'REASON_ID',
        'VisitTableMap::COL_REASON_ID' => 'REASON_ID',
        'COL_REASON_ID' => 'REASON_ID',
        'reason_id' => 'REASON_ID',
        'visit.reason_id' => 'REASON_ID',
        'ModalityId' => 'MODALITY_ID',
        'Visit.ModalityId' => 'MODALITY_ID',
        'modalityId' => 'MODALITY_ID',
        'visit.modalityId' => 'MODALITY_ID',
        'VisitTableMap::COL_MODALITY_ID' => 'MODALITY_ID',
        'COL_MODALITY_ID' => 'MODALITY_ID',
        'modality_id' => 'MODALITY_ID',
        'visit.modality_id' => 'MODALITY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Visit.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'visit.createdAt' => 'CREATED_AT',
        'VisitTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'visit.created_at' => 'CREATED_AT',
        'InvitedAt' => 'INVITED_AT',
        'Visit.InvitedAt' => 'INVITED_AT',
        'invitedAt' => 'INVITED_AT',
        'visit.invitedAt' => 'INVITED_AT',
        'VisitTableMap::COL_INVITED_AT' => 'INVITED_AT',
        'COL_INVITED_AT' => 'INVITED_AT',
        'invited_at' => 'INVITED_AT',
        'visit.invited_at' => 'INVITED_AT',
        'CompleteAt' => 'COMPLETE_AT',
        'Visit.CompleteAt' => 'COMPLETE_AT',
        'completeAt' => 'COMPLETE_AT',
        'visit.completeAt' => 'COMPLETE_AT',
        'VisitTableMap::COL_COMPLETE_AT' => 'COMPLETE_AT',
        'COL_COMPLETE_AT' => 'COMPLETE_AT',
        'complete_at' => 'COMPLETE_AT',
        'visit.complete_at' => 'COMPLETE_AT',
        'Position' => 'POSITION',
        'Visit.Position' => 'POSITION',
        'position' => 'POSITION',
        'visit.position' => 'POSITION',
        'VisitTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'CustomReason' => 'CUSTOM_REASON',
        'Visit.CustomReason' => 'CUSTOM_REASON',
        'customReason' => 'CUSTOM_REASON',
        'visit.customReason' => 'CUSTOM_REASON',
        'VisitTableMap::COL_CUSTOM_REASON' => 'CUSTOM_REASON',
        'COL_CUSTOM_REASON' => 'CUSTOM_REASON',
        'custom_reason' => 'CUSTOM_REASON',
        'visit.custom_reason' => 'CUSTOM_REASON',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('visit');
        $this->setPhpName('Visit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Visit');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'CHAR', true, 36, null);
        $this->addForeignKey('advisor_id', 'AdvisorId', 'CHAR', 'employee', 'uid', true, 7, null);
        $this->addForeignKey('student_id', 'StudentId', 'CHAR', 'student', 'uid', true, 7, null);
        $this->addForeignKey('reason_id', 'ReasonId', 'INTEGER', 'reason', 'id', true, null, null);
        $this->addForeignKey('modality_id', 'ModalityId', 'INTEGER', 'modality', 'id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, null);
        $this->addColumn('invited_at', 'InvitedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('complete_at', 'CompleteAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('position', 'Position', 'INTEGER', false, null, null);
        $this->addColumn('custom_reason', 'CustomReason', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Student', '\\Student', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':student_id',
    1 => ':uid',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':advisor_id',
    1 => ':uid',
  ),
), null, null, null, false);
        $this->addRelation('Reason', '\\Reason', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':reason_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Modality', '\\Modality', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':modality_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? VisitTableMap::CLASS_DEFAULT : VisitTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Visit object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VisitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VisitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VisitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VisitTableMap::OM_CLASS;
            /** @var Visit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VisitTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = VisitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VisitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Visit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VisitTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(VisitTableMap::COL_ID);
            $criteria->addSelectColumn(VisitTableMap::COL_ADVISOR_ID);
            $criteria->addSelectColumn(VisitTableMap::COL_STUDENT_ID);
            $criteria->addSelectColumn(VisitTableMap::COL_REASON_ID);
            $criteria->addSelectColumn(VisitTableMap::COL_MODALITY_ID);
            $criteria->addSelectColumn(VisitTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(VisitTableMap::COL_INVITED_AT);
            $criteria->addSelectColumn(VisitTableMap::COL_COMPLETE_AT);
            $criteria->addSelectColumn(VisitTableMap::COL_POSITION);
            $criteria->addSelectColumn(VisitTableMap::COL_CUSTOM_REASON);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.advisor_id');
            $criteria->addSelectColumn($alias . '.student_id');
            $criteria->addSelectColumn($alias . '.reason_id');
            $criteria->addSelectColumn($alias . '.modality_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.invited_at');
            $criteria->addSelectColumn($alias . '.complete_at');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.custom_reason');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(VisitTableMap::COL_ID);
            $criteria->removeSelectColumn(VisitTableMap::COL_ADVISOR_ID);
            $criteria->removeSelectColumn(VisitTableMap::COL_STUDENT_ID);
            $criteria->removeSelectColumn(VisitTableMap::COL_REASON_ID);
            $criteria->removeSelectColumn(VisitTableMap::COL_MODALITY_ID);
            $criteria->removeSelectColumn(VisitTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(VisitTableMap::COL_INVITED_AT);
            $criteria->removeSelectColumn(VisitTableMap::COL_COMPLETE_AT);
            $criteria->removeSelectColumn(VisitTableMap::COL_POSITION);
            $criteria->removeSelectColumn(VisitTableMap::COL_CUSTOM_REASON);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.advisor_id');
            $criteria->removeSelectColumn($alias . '.student_id');
            $criteria->removeSelectColumn($alias . '.reason_id');
            $criteria->removeSelectColumn($alias . '.modality_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.invited_at');
            $criteria->removeSelectColumn($alias . '.complete_at');
            $criteria->removeSelectColumn($alias . '.position');
            $criteria->removeSelectColumn($alias . '.custom_reason');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(VisitTableMap::DATABASE_NAME)->getTable(VisitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Visit or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Visit object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VisitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Visit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VisitTableMap::DATABASE_NAME);
            $criteria->add(VisitTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VisitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VisitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VisitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the visit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VisitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Visit or Criteria object.
     *
     * @param mixed               $criteria Criteria or Visit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VisitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Visit object
        }


        // Set the correct dbName
        $query = VisitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VisitTableMap
