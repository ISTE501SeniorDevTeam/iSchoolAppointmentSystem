<?php

namespace Map;

use \Hour;
use \HourQuery;
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
 * This class defines the structure of the 'hour' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HourTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.HourTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'hour';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Hour';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Hour';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'hour.id';

    /**
     * the column name for the advisor_id field
     */
    const COL_ADVISOR_ID = 'hour.advisor_id';

    /**
     * the column name for the date field
     */
    const COL_DATE = 'hour.date';

    /**
     * the column name for the start_recurrence field
     */
    const COL_START_RECURRENCE = 'hour.start_recurrence';

    /**
     * the column name for the end_recurrence field
     */
    const COL_END_RECURRENCE = 'hour.end_recurrence';

    /**
     * the column name for the start_time field
     */
    const COL_START_TIME = 'hour.start_time';

    /**
     * the column name for the end_time field
     */
    const COL_END_TIME = 'hour.end_time';

    /**
     * the column name for the day_of_week field
     */
    const COL_DAY_OF_WEEK = 'hour.day_of_week';

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
        self::TYPE_PHPNAME       => array('Id', 'AdvisorId', 'Date', 'StartRecurrence', 'EndRecurrence', 'StartTime', 'EndTime', 'DayOfWeek', ),
        self::TYPE_CAMELNAME     => array('id', 'advisorId', 'date', 'startRecurrence', 'endRecurrence', 'startTime', 'endTime', 'dayOfWeek', ),
        self::TYPE_COLNAME       => array(HourTableMap::COL_ID, HourTableMap::COL_ADVISOR_ID, HourTableMap::COL_DATE, HourTableMap::COL_START_RECURRENCE, HourTableMap::COL_END_RECURRENCE, HourTableMap::COL_START_TIME, HourTableMap::COL_END_TIME, HourTableMap::COL_DAY_OF_WEEK, ),
        self::TYPE_FIELDNAME     => array('id', 'advisor_id', 'date', 'start_recurrence', 'end_recurrence', 'start_time', 'end_time', 'day_of_week', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AdvisorId' => 1, 'Date' => 2, 'StartRecurrence' => 3, 'EndRecurrence' => 4, 'StartTime' => 5, 'EndTime' => 6, 'DayOfWeek' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'advisorId' => 1, 'date' => 2, 'startRecurrence' => 3, 'endRecurrence' => 4, 'startTime' => 5, 'endTime' => 6, 'dayOfWeek' => 7, ),
        self::TYPE_COLNAME       => array(HourTableMap::COL_ID => 0, HourTableMap::COL_ADVISOR_ID => 1, HourTableMap::COL_DATE => 2, HourTableMap::COL_START_RECURRENCE => 3, HourTableMap::COL_END_RECURRENCE => 4, HourTableMap::COL_START_TIME => 5, HourTableMap::COL_END_TIME => 6, HourTableMap::COL_DAY_OF_WEEK => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'advisor_id' => 1, 'date' => 2, 'start_recurrence' => 3, 'end_recurrence' => 4, 'start_time' => 5, 'end_time' => 6, 'day_of_week' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Hour.Id' => 'ID',
        'id' => 'ID',
        'hour.id' => 'ID',
        'HourTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'AdvisorId' => 'ADVISOR_ID',
        'Hour.AdvisorId' => 'ADVISOR_ID',
        'advisorId' => 'ADVISOR_ID',
        'hour.advisorId' => 'ADVISOR_ID',
        'HourTableMap::COL_ADVISOR_ID' => 'ADVISOR_ID',
        'COL_ADVISOR_ID' => 'ADVISOR_ID',
        'advisor_id' => 'ADVISOR_ID',
        'hour.advisor_id' => 'ADVISOR_ID',
        'Date' => 'DATE',
        'Hour.Date' => 'DATE',
        'date' => 'DATE',
        'hour.date' => 'DATE',
        'HourTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'StartRecurrence' => 'START_RECURRENCE',
        'Hour.StartRecurrence' => 'START_RECURRENCE',
        'startRecurrence' => 'START_RECURRENCE',
        'hour.startRecurrence' => 'START_RECURRENCE',
        'HourTableMap::COL_START_RECURRENCE' => 'START_RECURRENCE',
        'COL_START_RECURRENCE' => 'START_RECURRENCE',
        'start_recurrence' => 'START_RECURRENCE',
        'hour.start_recurrence' => 'START_RECURRENCE',
        'EndRecurrence' => 'END_RECURRENCE',
        'Hour.EndRecurrence' => 'END_RECURRENCE',
        'endRecurrence' => 'END_RECURRENCE',
        'hour.endRecurrence' => 'END_RECURRENCE',
        'HourTableMap::COL_END_RECURRENCE' => 'END_RECURRENCE',
        'COL_END_RECURRENCE' => 'END_RECURRENCE',
        'end_recurrence' => 'END_RECURRENCE',
        'hour.end_recurrence' => 'END_RECURRENCE',
        'StartTime' => 'START_TIME',
        'Hour.StartTime' => 'START_TIME',
        'startTime' => 'START_TIME',
        'hour.startTime' => 'START_TIME',
        'HourTableMap::COL_START_TIME' => 'START_TIME',
        'COL_START_TIME' => 'START_TIME',
        'start_time' => 'START_TIME',
        'hour.start_time' => 'START_TIME',
        'EndTime' => 'END_TIME',
        'Hour.EndTime' => 'END_TIME',
        'endTime' => 'END_TIME',
        'hour.endTime' => 'END_TIME',
        'HourTableMap::COL_END_TIME' => 'END_TIME',
        'COL_END_TIME' => 'END_TIME',
        'end_time' => 'END_TIME',
        'hour.end_time' => 'END_TIME',
        'DayOfWeek' => 'DAY_OF_WEEK',
        'Hour.DayOfWeek' => 'DAY_OF_WEEK',
        'dayOfWeek' => 'DAY_OF_WEEK',
        'hour.dayOfWeek' => 'DAY_OF_WEEK',
        'HourTableMap::COL_DAY_OF_WEEK' => 'DAY_OF_WEEK',
        'COL_DAY_OF_WEEK' => 'DAY_OF_WEEK',
        'day_of_week' => 'DAY_OF_WEEK',
        'hour.day_of_week' => 'DAY_OF_WEEK',
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
        $this->setName('hour');
        $this->setPhpName('Hour');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Hour');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('advisor_id', 'AdvisorId', 'CHAR', 'employee', 'uid', true, 7, null);
        $this->addColumn('date', 'Date', 'TIMESTAMP', false, null, null);
        $this->addColumn('start_recurrence', 'StartRecurrence', 'TIMESTAMP', false, null, null);
        $this->addColumn('end_recurrence', 'EndRecurrence', 'TIMESTAMP', false, null, null);
        $this->addColumn('start_time', 'StartTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('end_time', 'EndTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('day_of_week', 'DayOfWeek', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Employee', '\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':advisor_id',
    1 => ':uid',
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
        return (int) $row[
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
        return $withPrefix ? HourTableMap::CLASS_DEFAULT : HourTableMap::OM_CLASS;
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
     * @return array           (Hour object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = HourTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HourTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HourTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HourTableMap::OM_CLASS;
            /** @var Hour $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HourTableMap::addInstanceToPool($obj, $key);
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
            $key = HourTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HourTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Hour $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HourTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HourTableMap::COL_ID);
            $criteria->addSelectColumn(HourTableMap::COL_ADVISOR_ID);
            $criteria->addSelectColumn(HourTableMap::COL_DATE);
            $criteria->addSelectColumn(HourTableMap::COL_START_RECURRENCE);
            $criteria->addSelectColumn(HourTableMap::COL_END_RECURRENCE);
            $criteria->addSelectColumn(HourTableMap::COL_START_TIME);
            $criteria->addSelectColumn(HourTableMap::COL_END_TIME);
            $criteria->addSelectColumn(HourTableMap::COL_DAY_OF_WEEK);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.advisor_id');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.start_recurrence');
            $criteria->addSelectColumn($alias . '.end_recurrence');
            $criteria->addSelectColumn($alias . '.start_time');
            $criteria->addSelectColumn($alias . '.end_time');
            $criteria->addSelectColumn($alias . '.day_of_week');
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
            $criteria->removeSelectColumn(HourTableMap::COL_ID);
            $criteria->removeSelectColumn(HourTableMap::COL_ADVISOR_ID);
            $criteria->removeSelectColumn(HourTableMap::COL_DATE);
            $criteria->removeSelectColumn(HourTableMap::COL_START_RECURRENCE);
            $criteria->removeSelectColumn(HourTableMap::COL_END_RECURRENCE);
            $criteria->removeSelectColumn(HourTableMap::COL_START_TIME);
            $criteria->removeSelectColumn(HourTableMap::COL_END_TIME);
            $criteria->removeSelectColumn(HourTableMap::COL_DAY_OF_WEEK);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.advisor_id');
            $criteria->removeSelectColumn($alias . '.date');
            $criteria->removeSelectColumn($alias . '.start_recurrence');
            $criteria->removeSelectColumn($alias . '.end_recurrence');
            $criteria->removeSelectColumn($alias . '.start_time');
            $criteria->removeSelectColumn($alias . '.end_time');
            $criteria->removeSelectColumn($alias . '.day_of_week');
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
        return Propel::getServiceContainer()->getDatabaseMap(HourTableMap::DATABASE_NAME)->getTable(HourTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Hour or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Hour object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HourTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Hour) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HourTableMap::DATABASE_NAME);
            $criteria->add(HourTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = HourQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HourTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HourTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the hour table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return HourQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Hour or Criteria object.
     *
     * @param mixed               $criteria Criteria or Hour object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HourTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Hour object
        }

        if ($criteria->containsKey(HourTableMap::COL_ID) && $criteria->keyContainsValue(HourTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HourTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = HourQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // HourTableMap
