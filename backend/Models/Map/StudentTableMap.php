<?php

namespace Map;

use \Student;
use \StudentQuery;
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
 * This class defines the structure of the 'student' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StudentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.StudentTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'student';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Student';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Student';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the uid field
     */
    const COL_UID = 'student.uid';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'student.name';

    /**
     * the column name for the major_id field
     */
    const COL_MAJOR_ID = 'student.major_id';

    /**
     * the column name for the advisor_id field
     */
    const COL_ADVISOR_ID = 'student.advisor_id';

    /**
     * the column name for the ritid field
     */
    const COL_RITID = 'student.ritid';

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
        self::TYPE_PHPNAME       => array('Uid', 'Name', 'MajorId', 'AdvisorId', 'Ritid', ),
        self::TYPE_CAMELNAME     => array('uid', 'name', 'majorId', 'advisorId', 'ritid', ),
        self::TYPE_COLNAME       => array(StudentTableMap::COL_UID, StudentTableMap::COL_NAME, StudentTableMap::COL_MAJOR_ID, StudentTableMap::COL_ADVISOR_ID, StudentTableMap::COL_RITID, ),
        self::TYPE_FIELDNAME     => array('uid', 'name', 'major_id', 'advisor_id', 'ritid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Uid' => 0, 'Name' => 1, 'MajorId' => 2, 'AdvisorId' => 3, 'Ritid' => 4, ),
        self::TYPE_CAMELNAME     => array('uid' => 0, 'name' => 1, 'majorId' => 2, 'advisorId' => 3, 'ritid' => 4, ),
        self::TYPE_COLNAME       => array(StudentTableMap::COL_UID => 0, StudentTableMap::COL_NAME => 1, StudentTableMap::COL_MAJOR_ID => 2, StudentTableMap::COL_ADVISOR_ID => 3, StudentTableMap::COL_RITID => 4, ),
        self::TYPE_FIELDNAME     => array('uid' => 0, 'name' => 1, 'major_id' => 2, 'advisor_id' => 3, 'ritid' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Uid' => 'UID',
        'Student.Uid' => 'UID',
        'uid' => 'UID',
        'student.uid' => 'UID',
        'StudentTableMap::COL_UID' => 'UID',
        'COL_UID' => 'UID',
        'Name' => 'NAME',
        'Student.Name' => 'NAME',
        'name' => 'NAME',
        'student.name' => 'NAME',
        'StudentTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'MajorId' => 'MAJOR_ID',
        'Student.MajorId' => 'MAJOR_ID',
        'majorId' => 'MAJOR_ID',
        'student.majorId' => 'MAJOR_ID',
        'StudentTableMap::COL_MAJOR_ID' => 'MAJOR_ID',
        'COL_MAJOR_ID' => 'MAJOR_ID',
        'major_id' => 'MAJOR_ID',
        'student.major_id' => 'MAJOR_ID',
        'AdvisorId' => 'ADVISOR_ID',
        'Student.AdvisorId' => 'ADVISOR_ID',
        'advisorId' => 'ADVISOR_ID',
        'student.advisorId' => 'ADVISOR_ID',
        'StudentTableMap::COL_ADVISOR_ID' => 'ADVISOR_ID',
        'COL_ADVISOR_ID' => 'ADVISOR_ID',
        'advisor_id' => 'ADVISOR_ID',
        'student.advisor_id' => 'ADVISOR_ID',
        'Ritid' => 'RITID',
        'Student.Ritid' => 'RITID',
        'ritid' => 'RITID',
        'student.ritid' => 'RITID',
        'StudentTableMap::COL_RITID' => 'RITID',
        'COL_RITID' => 'RITID',
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
        $this->setName('student');
        $this->setPhpName('Student');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Student');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uid', 'Uid', 'CHAR', true, 7, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addForeignKey('major_id', 'MajorId', 'INTEGER', 'major', 'id', false, null, null);
        $this->addForeignKey('advisor_id', 'AdvisorId', 'CHAR', 'employee', 'uid', false, 7, null);
        $this->addColumn('ritid', 'Ritid', 'CHAR', false, 9, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Major', '\\Major', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':major_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':advisor_id',
    1 => ':uid',
  ),
), null, null, null, false);
        $this->addRelation('Visit', '\\Visit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':student_id',
    1 => ':uid',
  ),
), null, null, 'Visits', false);
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
        return $withPrefix ? StudentTableMap::CLASS_DEFAULT : StudentTableMap::OM_CLASS;
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
     * @return array           (Student object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = StudentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StudentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StudentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StudentTableMap::OM_CLASS;
            /** @var Student $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StudentTableMap::addInstanceToPool($obj, $key);
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
            $key = StudentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StudentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Student $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StudentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StudentTableMap::COL_UID);
            $criteria->addSelectColumn(StudentTableMap::COL_NAME);
            $criteria->addSelectColumn(StudentTableMap::COL_MAJOR_ID);
            $criteria->addSelectColumn(StudentTableMap::COL_ADVISOR_ID);
            $criteria->addSelectColumn(StudentTableMap::COL_RITID);
        } else {
            $criteria->addSelectColumn($alias . '.uid');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.major_id');
            $criteria->addSelectColumn($alias . '.advisor_id');
            $criteria->addSelectColumn($alias . '.ritid');
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
            $criteria->removeSelectColumn(StudentTableMap::COL_UID);
            $criteria->removeSelectColumn(StudentTableMap::COL_NAME);
            $criteria->removeSelectColumn(StudentTableMap::COL_MAJOR_ID);
            $criteria->removeSelectColumn(StudentTableMap::COL_ADVISOR_ID);
            $criteria->removeSelectColumn(StudentTableMap::COL_RITID);
        } else {
            $criteria->removeSelectColumn($alias . '.uid');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.major_id');
            $criteria->removeSelectColumn($alias . '.advisor_id');
            $criteria->removeSelectColumn($alias . '.ritid');
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
        return Propel::getServiceContainer()->getDatabaseMap(StudentTableMap::DATABASE_NAME)->getTable(StudentTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Student or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Student object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StudentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Student) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StudentTableMap::DATABASE_NAME);
            $criteria->add(StudentTableMap::COL_UID, (array) $values, Criteria::IN);
        }

        $query = StudentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StudentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StudentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the student table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return StudentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Student or Criteria object.
     *
     * @param mixed               $criteria Criteria or Student object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StudentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Student object
        }


        // Set the correct dbName
        $query = StudentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // StudentTableMap
