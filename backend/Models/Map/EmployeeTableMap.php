<?php

namespace Map;

use \Employee;
use \EmployeeQuery;
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
 * This class defines the structure of the 'employee' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.EmployeeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'employee';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Employee';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Employee';

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
     * the column name for the uid field
     */
    const COL_UID = 'employee.uid';

    /**
     * the column name for the hash field
     */
    const COL_HASH = 'employee.hash';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'employee.name';

    /**
     * the column name for the role_id field
     */
    const COL_ROLE_ID = 'employee.role_id';

    /**
     * the column name for the picture_url field
     */
    const COL_PICTURE_URL = 'employee.picture_url';

    /**
     * the column name for the is_grad_advisor field
     */
    const COL_IS_GRAD_ADVISOR = 'employee.is_grad_advisor';

    /**
     * the column name for the first_letter field
     */
    const COL_FIRST_LETTER = 'employee.first_letter';

    /**
     * the column name for the last_letter field
     */
    const COL_LAST_LETTER = 'employee.last_letter';

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
        self::TYPE_PHPNAME       => array('Uid', 'Hash', 'Name', 'RoleId', 'PictureUrl', 'IsGradAdvisor', 'FirstLetter', 'LastLetter', ),
        self::TYPE_CAMELNAME     => array('uid', 'hash', 'name', 'roleId', 'pictureUrl', 'isGradAdvisor', 'firstLetter', 'lastLetter', ),
        self::TYPE_COLNAME       => array(EmployeeTableMap::COL_UID, EmployeeTableMap::COL_HASH, EmployeeTableMap::COL_NAME, EmployeeTableMap::COL_ROLE_ID, EmployeeTableMap::COL_PICTURE_URL, EmployeeTableMap::COL_IS_GRAD_ADVISOR, EmployeeTableMap::COL_FIRST_LETTER, EmployeeTableMap::COL_LAST_LETTER, ),
        self::TYPE_FIELDNAME     => array('uid', 'hash', 'name', 'role_id', 'picture_url', 'is_grad_advisor', 'first_letter', 'last_letter', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Uid' => 0, 'Hash' => 1, 'Name' => 2, 'RoleId' => 3, 'PictureUrl' => 4, 'IsGradAdvisor' => 5, 'FirstLetter' => 6, 'LastLetter' => 7, ),
        self::TYPE_CAMELNAME     => array('uid' => 0, 'hash' => 1, 'name' => 2, 'roleId' => 3, 'pictureUrl' => 4, 'isGradAdvisor' => 5, 'firstLetter' => 6, 'lastLetter' => 7, ),
        self::TYPE_COLNAME       => array(EmployeeTableMap::COL_UID => 0, EmployeeTableMap::COL_HASH => 1, EmployeeTableMap::COL_NAME => 2, EmployeeTableMap::COL_ROLE_ID => 3, EmployeeTableMap::COL_PICTURE_URL => 4, EmployeeTableMap::COL_IS_GRAD_ADVISOR => 5, EmployeeTableMap::COL_FIRST_LETTER => 6, EmployeeTableMap::COL_LAST_LETTER => 7, ),
        self::TYPE_FIELDNAME     => array('uid' => 0, 'hash' => 1, 'name' => 2, 'role_id' => 3, 'picture_url' => 4, 'is_grad_advisor' => 5, 'first_letter' => 6, 'last_letter' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Uid' => 'UID',
        'Employee.Uid' => 'UID',
        'uid' => 'UID',
        'employee.uid' => 'UID',
        'EmployeeTableMap::COL_UID' => 'UID',
        'COL_UID' => 'UID',
        'Hash' => 'HASH',
        'Employee.Hash' => 'HASH',
        'hash' => 'HASH',
        'employee.hash' => 'HASH',
        'EmployeeTableMap::COL_HASH' => 'HASH',
        'COL_HASH' => 'HASH',
        'Name' => 'NAME',
        'Employee.Name' => 'NAME',
        'name' => 'NAME',
        'employee.name' => 'NAME',
        'EmployeeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'RoleId' => 'ROLE_ID',
        'Employee.RoleId' => 'ROLE_ID',
        'roleId' => 'ROLE_ID',
        'employee.roleId' => 'ROLE_ID',
        'EmployeeTableMap::COL_ROLE_ID' => 'ROLE_ID',
        'COL_ROLE_ID' => 'ROLE_ID',
        'role_id' => 'ROLE_ID',
        'employee.role_id' => 'ROLE_ID',
        'PictureUrl' => 'PICTURE_URL',
        'Employee.PictureUrl' => 'PICTURE_URL',
        'pictureUrl' => 'PICTURE_URL',
        'employee.pictureUrl' => 'PICTURE_URL',
        'EmployeeTableMap::COL_PICTURE_URL' => 'PICTURE_URL',
        'COL_PICTURE_URL' => 'PICTURE_URL',
        'picture_url' => 'PICTURE_URL',
        'employee.picture_url' => 'PICTURE_URL',
        'IsGradAdvisor' => 'IS_GRAD_ADVISOR',
        'Employee.IsGradAdvisor' => 'IS_GRAD_ADVISOR',
        'isGradAdvisor' => 'IS_GRAD_ADVISOR',
        'employee.isGradAdvisor' => 'IS_GRAD_ADVISOR',
        'EmployeeTableMap::COL_IS_GRAD_ADVISOR' => 'IS_GRAD_ADVISOR',
        'COL_IS_GRAD_ADVISOR' => 'IS_GRAD_ADVISOR',
        'is_grad_advisor' => 'IS_GRAD_ADVISOR',
        'employee.is_grad_advisor' => 'IS_GRAD_ADVISOR',
        'FirstLetter' => 'FIRST_LETTER',
        'Employee.FirstLetter' => 'FIRST_LETTER',
        'firstLetter' => 'FIRST_LETTER',
        'employee.firstLetter' => 'FIRST_LETTER',
        'EmployeeTableMap::COL_FIRST_LETTER' => 'FIRST_LETTER',
        'COL_FIRST_LETTER' => 'FIRST_LETTER',
        'first_letter' => 'FIRST_LETTER',
        'employee.first_letter' => 'FIRST_LETTER',
        'LastLetter' => 'LAST_LETTER',
        'Employee.LastLetter' => 'LAST_LETTER',
        'lastLetter' => 'LAST_LETTER',
        'employee.lastLetter' => 'LAST_LETTER',
        'EmployeeTableMap::COL_LAST_LETTER' => 'LAST_LETTER',
        'COL_LAST_LETTER' => 'LAST_LETTER',
        'last_letter' => 'LAST_LETTER',
        'employee.last_letter' => 'LAST_LETTER',
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
        $this->setName('employee');
        $this->setPhpName('Employee');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Employee');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uid', 'Uid', 'CHAR', true, 7, null);
        $this->addColumn('hash', 'Hash', 'CHAR', false, 60, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addForeignKey('role_id', 'RoleId', 'INTEGER', 'role', 'id', true, null, null);
        $this->addColumn('picture_url', 'PictureUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('is_grad_advisor', 'IsGradAdvisor', 'BOOLEAN', false, 1, null);
        $this->addColumn('first_letter', 'FirstLetter', 'CHAR', false, 4, null);
        $this->addColumn('last_letter', 'LastLetter', 'CHAR', false, 4, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Role', '\\Role', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Visit', '\\Visit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':advisor_id',
    1 => ':uid',
  ),
), null, null, 'Visits', false);
        $this->addRelation('Student', '\\Student', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':advisor_id',
    1 => ':uid',
  ),
), null, null, 'Students', false);
        $this->addRelation('Token', '\\Token', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employeeId',
    1 => ':uid',
  ),
), null, null, 'Tokens', false);
        $this->addRelation('WalkinHour', '\\WalkinHour', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':advisor_id',
    1 => ':uid',
  ),
), null, null, 'WalkinHours', false);
        $this->addRelation('Hour', '\\Hour', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':advisor_id',
    1 => ':uid',
  ),
), null, null, 'Hours', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeeTableMap::CLASS_DEFAULT : EmployeeTableMap::OM_CLASS;
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
     * @return array           (Employee object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmployeeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeTableMap::OM_CLASS;
            /** @var Employee $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employee $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeTableMap::COL_UID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_HASH);
            $criteria->addSelectColumn(EmployeeTableMap::COL_NAME);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PICTURE_URL);
            $criteria->addSelectColumn(EmployeeTableMap::COL_IS_GRAD_ADVISOR);
            $criteria->addSelectColumn(EmployeeTableMap::COL_FIRST_LETTER);
            $criteria->addSelectColumn(EmployeeTableMap::COL_LAST_LETTER);
        } else {
            $criteria->addSelectColumn($alias . '.uid');
            $criteria->addSelectColumn($alias . '.hash');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.role_id');
            $criteria->addSelectColumn($alias . '.picture_url');
            $criteria->addSelectColumn($alias . '.is_grad_advisor');
            $criteria->addSelectColumn($alias . '.first_letter');
            $criteria->addSelectColumn($alias . '.last_letter');
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
            $criteria->removeSelectColumn(EmployeeTableMap::COL_UID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_HASH);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_NAME);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_ROLE_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_PICTURE_URL);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_IS_GRAD_ADVISOR);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_FIRST_LETTER);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_LAST_LETTER);
        } else {
            $criteria->removeSelectColumn($alias . '.uid');
            $criteria->removeSelectColumn($alias . '.hash');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.role_id');
            $criteria->removeSelectColumn($alias . '.picture_url');
            $criteria->removeSelectColumn($alias . '.is_grad_advisor');
            $criteria->removeSelectColumn($alias . '.first_letter');
            $criteria->removeSelectColumn($alias . '.last_letter');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeTableMap::DATABASE_NAME)->getTable(EmployeeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Employee or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Employee object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Employee) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeTableMap::DATABASE_NAME);
            $criteria->add(EmployeeTableMap::COL_UID, (array) $values, Criteria::IN);
        }

        $query = EmployeeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmployeeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employee or Criteria object.
     *
     * @param mixed               $criteria Criteria or Employee object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employee object
        }


        // Set the correct dbName
        $query = EmployeeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmployeeTableMap
