<?php

namespace Map;

use \WalkinHour;
use \WalkinHourQuery;
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
 * This class defines the structure of the 'walkin_hour' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WalkinHourTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.WalkinHourTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'walkin_hour';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WalkinHour';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WalkinHour';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the advisor_id field
     */
    const COL_ADVISOR_ID = 'walkin_hour.advisor_id';

    /**
     * the column name for the starts_at field
     */
    const COL_STARTS_AT = 'walkin_hour.starts_at';

    /**
     * the column name for the ends_at field
     */
    const COL_ENDS_AT = 'walkin_hour.ends_at';

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
        self::TYPE_PHPNAME       => array('AdvisorId', 'StartsAt', 'EndsAt', ),
        self::TYPE_CAMELNAME     => array('advisorId', 'startsAt', 'endsAt', ),
        self::TYPE_COLNAME       => array(WalkinHourTableMap::COL_ADVISOR_ID, WalkinHourTableMap::COL_STARTS_AT, WalkinHourTableMap::COL_ENDS_AT, ),
        self::TYPE_FIELDNAME     => array('advisor_id', 'starts_at', 'ends_at', ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('AdvisorId' => 0, 'StartsAt' => 1, 'EndsAt' => 2, ),
        self::TYPE_CAMELNAME     => array('advisorId' => 0, 'startsAt' => 1, 'endsAt' => 2, ),
        self::TYPE_COLNAME       => array(WalkinHourTableMap::COL_ADVISOR_ID => 0, WalkinHourTableMap::COL_STARTS_AT => 1, WalkinHourTableMap::COL_ENDS_AT => 2, ),
        self::TYPE_FIELDNAME     => array('advisor_id' => 0, 'starts_at' => 1, 'ends_at' => 2, ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'AdvisorId' => 'ADVISOR_ID',
        'WalkinHour.AdvisorId' => 'ADVISOR_ID',
        'advisorId' => 'ADVISOR_ID',
        'walkinHour.advisorId' => 'ADVISOR_ID',
        'WalkinHourTableMap::COL_ADVISOR_ID' => 'ADVISOR_ID',
        'COL_ADVISOR_ID' => 'ADVISOR_ID',
        'advisor_id' => 'ADVISOR_ID',
        'walkin_hour.advisor_id' => 'ADVISOR_ID',
        'StartsAt' => 'STARTS_AT',
        'WalkinHour.StartsAt' => 'STARTS_AT',
        'startsAt' => 'STARTS_AT',
        'walkinHour.startsAt' => 'STARTS_AT',
        'WalkinHourTableMap::COL_STARTS_AT' => 'STARTS_AT',
        'COL_STARTS_AT' => 'STARTS_AT',
        'starts_at' => 'STARTS_AT',
        'walkin_hour.starts_at' => 'STARTS_AT',
        'EndsAt' => 'ENDS_AT',
        'WalkinHour.EndsAt' => 'ENDS_AT',
        'endsAt' => 'ENDS_AT',
        'walkinHour.endsAt' => 'ENDS_AT',
        'WalkinHourTableMap::COL_ENDS_AT' => 'ENDS_AT',
        'COL_ENDS_AT' => 'ENDS_AT',
        'ends_at' => 'ENDS_AT',
        'walkin_hour.ends_at' => 'ENDS_AT',
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
        $this->setName('walkin_hour');
        $this->setPhpName('WalkinHour');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WalkinHour');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('advisor_id', 'AdvisorId', 'CHAR' , 'employee', 'uid', true, 7, null);
        $this->addPrimaryKey('starts_at', 'StartsAt', 'TIMESTAMP', true, null, null);
        $this->addPrimaryKey('ends_at', 'EndsAt', 'TIMESTAMP', true, null, null);
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
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \WalkinHour $obj A \WalkinHour object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getAdvisorId() || is_scalar($obj->getAdvisorId()) || is_callable([$obj->getAdvisorId(), '__toString']) ? (string) $obj->getAdvisorId() : $obj->getAdvisorId()), (null === $obj->getStartsAt() || is_scalar($obj->getStartsAt()) || is_callable([$obj->getStartsAt(), '__toString']) ? (string) $obj->getStartsAt() : $obj->getStartsAt()), (null === $obj->getEndsAt() || is_scalar($obj->getEndsAt()) || is_callable([$obj->getEndsAt(), '__toString']) ? (string) $obj->getEndsAt() : $obj->getEndsAt())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \WalkinHour object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \WalkinHour) {
                $key = serialize([(null === $value->getAdvisorId() || is_scalar($value->getAdvisorId()) || is_callable([$value->getAdvisorId(), '__toString']) ? (string) $value->getAdvisorId() : $value->getAdvisorId()), (null === $value->getStartsAt() || is_scalar($value->getStartsAt()) || is_callable([$value->getStartsAt(), '__toString']) ? (string) $value->getStartsAt() : $value->getStartsAt()), (null === $value->getEndsAt() || is_scalar($value->getEndsAt()) || is_callable([$value->getEndsAt(), '__toString']) ? (string) $value->getEndsAt() : $value->getEndsAt())]);

            } elseif (is_array($value) && count($value) === 3) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1]), (null === $value[2] || is_scalar($value[2]) || is_callable([$value[2], '__toString']) ? (string) $value[2] : $value[2])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \WalkinHour object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('StartsAt', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('EndsAt', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('StartsAt', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('StartsAt', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('StartsAt', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('StartsAt', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('StartsAt', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('EndsAt', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('EndsAt', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('EndsAt', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('EndsAt', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('EndsAt', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('StartsAt', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('EndsAt', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? WalkinHourTableMap::CLASS_DEFAULT : WalkinHourTableMap::OM_CLASS;
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
     * @return array           (WalkinHour object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WalkinHourTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WalkinHourTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WalkinHourTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WalkinHourTableMap::OM_CLASS;
            /** @var WalkinHour $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WalkinHourTableMap::addInstanceToPool($obj, $key);
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
            $key = WalkinHourTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WalkinHourTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WalkinHour $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WalkinHourTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WalkinHourTableMap::COL_ADVISOR_ID);
            $criteria->addSelectColumn(WalkinHourTableMap::COL_STARTS_AT);
            $criteria->addSelectColumn(WalkinHourTableMap::COL_ENDS_AT);
        } else {
            $criteria->addSelectColumn($alias . '.advisor_id');
            $criteria->addSelectColumn($alias . '.starts_at');
            $criteria->addSelectColumn($alias . '.ends_at');
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
            $criteria->removeSelectColumn(WalkinHourTableMap::COL_ADVISOR_ID);
            $criteria->removeSelectColumn(WalkinHourTableMap::COL_STARTS_AT);
            $criteria->removeSelectColumn(WalkinHourTableMap::COL_ENDS_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.advisor_id');
            $criteria->removeSelectColumn($alias . '.starts_at');
            $criteria->removeSelectColumn($alias . '.ends_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(WalkinHourTableMap::DATABASE_NAME)->getTable(WalkinHourTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WalkinHour or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WalkinHour object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WalkinHourTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WalkinHour) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WalkinHourTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(WalkinHourTableMap::COL_ADVISOR_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(WalkinHourTableMap::COL_STARTS_AT, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(WalkinHourTableMap::COL_ENDS_AT, $value[2]));
                $criteria->addOr($criterion);
            }
        }

        $query = WalkinHourQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WalkinHourTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WalkinHourTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the walkin_hour table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WalkinHourQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WalkinHour or Criteria object.
     *
     * @param mixed               $criteria Criteria or WalkinHour object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WalkinHourTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WalkinHour object
        }


        // Set the correct dbName
        $query = WalkinHourQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WalkinHourTableMap
