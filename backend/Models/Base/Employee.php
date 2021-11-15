<?php

namespace Base;

use \Employee as ChildEmployee;
use \EmployeeQuery as ChildEmployeeQuery;
use \Hour as ChildHour;
use \HourQuery as ChildHourQuery;
use \Role as ChildRole;
use \RoleQuery as ChildRoleQuery;
use \Student as ChildStudent;
use \StudentQuery as ChildStudentQuery;
use \Token as ChildToken;
use \TokenQuery as ChildTokenQuery;
use \Visit as ChildVisit;
use \VisitQuery as ChildVisitQuery;
use \WalkinHour as ChildWalkinHour;
use \WalkinHourQuery as ChildWalkinHourQuery;
use \Exception;
use \PDO;
use Map\EmployeeTableMap;
use Map\HourTableMap;
use Map\StudentTableMap;
use Map\TokenTableMap;
use Map\VisitTableMap;
use Map\WalkinHourTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'employee' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Employee implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\EmployeeTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the uid field.
     *
     * @var        string
     */
    protected $uid;

    /**
     * The value for the hash field.
     *
     * @var        string|null
     */
    protected $hash;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the role_id field.
     *
     * @var        int
     */
    protected $role_id;

    /**
     * The value for the picture_url field.
     *
     * @var        string|null
     */
    protected $picture_url;

    /**
     * The value for the is_grad_advisor field.
     *
     * @var        boolean|null
     */
    protected $is_grad_advisor;

    /**
     * The value for the first_letter field.
     *
     * @var        string|null
     */
    protected $first_letter;

    /**
     * The value for the last_letter field.
     *
     * @var        string|null
     */
    protected $last_letter;

    /**
     * @var        ChildRole
     */
    protected $aRole;

    /**
     * @var        ObjectCollection|ChildVisit[] Collection to store aggregation of ChildVisit objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildVisit> Collection to store aggregation of ChildVisit objects.
     */
    protected $collVisits;
    protected $collVisitsPartial;

    /**
     * @var        ObjectCollection|ChildStudent[] Collection to store aggregation of ChildStudent objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStudent> Collection to store aggregation of ChildStudent objects.
     */
    protected $collStudents;
    protected $collStudentsPartial;

    /**
     * @var        ObjectCollection|ChildToken[] Collection to store aggregation of ChildToken objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildToken> Collection to store aggregation of ChildToken objects.
     */
    protected $collTokens;
    protected $collTokensPartial;

    /**
     * @var        ObjectCollection|ChildWalkinHour[] Collection to store aggregation of ChildWalkinHour objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWalkinHour> Collection to store aggregation of ChildWalkinHour objects.
     */
    protected $collWalkinHours;
    protected $collWalkinHoursPartial;

    /**
     * @var        ObjectCollection|ChildHour[] Collection to store aggregation of ChildHour objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHour> Collection to store aggregation of ChildHour objects.
     */
    protected $collHours;
    protected $collHoursPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVisit[]
     * @phpstan-var ObjectCollection&\Traversable<ChildVisit>
     */
    protected $visitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStudent[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStudent>
     */
    protected $studentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildToken[]
     * @phpstan-var ObjectCollection&\Traversable<ChildToken>
     */
    protected $tokensScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWalkinHour[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWalkinHour>
     */
    protected $walkinHoursScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHour[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHour>
     */
    protected $hoursScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Employee object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Employee</code> instance.  If
     * <code>obj</code> is an instance of <code>Employee</code>, delegates to
     * <code>equals(Employee)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [uid] column value.
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Get the [hash] column value.
     *
     * @return string|null
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [role_id] column value.
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Get the [picture_url] column value.
     *
     * @return string|null
     */
    public function getPictureUrl()
    {
        return $this->picture_url;
    }

    /**
     * Get the [is_grad_advisor] column value.
     *
     * @return boolean|null
     */
    public function getIsGradAdvisor()
    {
        return $this->is_grad_advisor;
    }

    /**
     * Get the [is_grad_advisor] column value.
     *
     * @return boolean|null
     */
    public function isGradAdvisor()
    {
        return $this->getIsGradAdvisor();
    }

    /**
     * Get the [first_letter] column value.
     *
     * @return string|null
     */
    public function getFirstLetter()
    {
        return $this->first_letter;
    }

    /**
     * Get the [last_letter] column value.
     *
     * @return string|null
     */
    public function getLastLetter()
    {
        return $this->last_letter;
    }

    /**
     * Set the value of [uid] column.
     *
     * @param string $v New value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setUid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uid !== $v) {
            $this->uid = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_UID] = true;
        }

        return $this;
    } // setUid()

    /**
     * Set the value of [hash] column.
     *
     * @param string|null $v New value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setHash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->hash !== $v) {
            $this->hash = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_HASH] = true;
        }

        return $this;
    } // setHash()

    /**
     * Set the value of [name] column.
     *
     * @param string $v New value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [role_id] column.
     *
     * @param int $v New value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setRoleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->role_id !== $v) {
            $this->role_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ROLE_ID] = true;
        }

        if ($this->aRole !== null && $this->aRole->getId() !== $v) {
            $this->aRole = null;
        }

        return $this;
    } // setRoleId()

    /**
     * Set the value of [picture_url] column.
     *
     * @param string|null $v New value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setPictureUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->picture_url !== $v) {
            $this->picture_url = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_PICTURE_URL] = true;
        }

        return $this;
    } // setPictureUrl()

    /**
     * Sets the value of the [is_grad_advisor] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string|null $v The new value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setIsGradAdvisor($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_grad_advisor !== $v) {
            $this->is_grad_advisor = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_IS_GRAD_ADVISOR] = true;
        }

        return $this;
    } // setIsGradAdvisor()

    /**
     * Set the value of [first_letter] column.
     *
     * @param string|null $v New value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setFirstLetter($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_letter !== $v) {
            $this->first_letter = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_FIRST_LETTER] = true;
        }

        return $this;
    } // setFirstLetter()

    /**
     * Set the value of [last_letter] column.
     *
     * @param string|null $v New value
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function setLastLetter($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_letter !== $v) {
            $this->last_letter = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_LAST_LETTER] = true;
        }

        return $this;
    } // setLastLetter()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmployeeTableMap::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmployeeTableMap::translateFieldName('Hash', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hash = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmployeeTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmployeeTableMap::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmployeeTableMap::translateFieldName('PictureUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->picture_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EmployeeTableMap::translateFieldName('IsGradAdvisor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_grad_advisor = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EmployeeTableMap::translateFieldName('FirstLetter', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_letter = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EmployeeTableMap::translateFieldName('LastLetter', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_letter = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = EmployeeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Employee'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aRole !== null && $this->role_id !== $this->aRole->getId()) {
            $this->aRole = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEmployeeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aRole = null;
            $this->collVisits = null;

            $this->collStudents = null;

            $this->collTokens = null;

            $this->collWalkinHours = null;

            $this->collHours = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Employee::setDeleted()
     * @see Employee::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEmployeeQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EmployeeTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aRole !== null) {
                if ($this->aRole->isModified() || $this->aRole->isNew()) {
                    $affectedRows += $this->aRole->save($con);
                }
                $this->setRole($this->aRole);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->visitsScheduledForDeletion !== null) {
                if (!$this->visitsScheduledForDeletion->isEmpty()) {
                    \VisitQuery::create()
                        ->filterByPrimaryKeys($this->visitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->visitsScheduledForDeletion = null;
                }
            }

            if ($this->collVisits !== null) {
                foreach ($this->collVisits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->studentsScheduledForDeletion !== null) {
                if (!$this->studentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->studentsScheduledForDeletion as $student) {
                        // need to save related object because we set the relation to null
                        $student->save($con);
                    }
                    $this->studentsScheduledForDeletion = null;
                }
            }

            if ($this->collStudents !== null) {
                foreach ($this->collStudents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tokensScheduledForDeletion !== null) {
                if (!$this->tokensScheduledForDeletion->isEmpty()) {
                    \TokenQuery::create()
                        ->filterByPrimaryKeys($this->tokensScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tokensScheduledForDeletion = null;
                }
            }

            if ($this->collTokens !== null) {
                foreach ($this->collTokens as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->walkinHoursScheduledForDeletion !== null) {
                if (!$this->walkinHoursScheduledForDeletion->isEmpty()) {
                    \WalkinHourQuery::create()
                        ->filterByPrimaryKeys($this->walkinHoursScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->walkinHoursScheduledForDeletion = null;
                }
            }

            if ($this->collWalkinHours !== null) {
                foreach ($this->collWalkinHours as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hoursScheduledForDeletion !== null) {
                if (!$this->hoursScheduledForDeletion->isEmpty()) {
                    \HourQuery::create()
                        ->filterByPrimaryKeys($this->hoursScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->hoursScheduledForDeletion = null;
                }
            }

            if ($this->collHours !== null) {
                foreach ($this->collHours as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmployeeTableMap::COL_UID)) {
            $modifiedColumns[':p' . $index++]  = 'uid';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_HASH)) {
            $modifiedColumns[':p' . $index++]  = 'hash';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ROLE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'role_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PICTURE_URL)) {
            $modifiedColumns[':p' . $index++]  = 'picture_url';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_IS_GRAD_ADVISOR)) {
            $modifiedColumns[':p' . $index++]  = 'is_grad_advisor';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_FIRST_LETTER)) {
            $modifiedColumns[':p' . $index++]  = 'first_letter';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_LETTER)) {
            $modifiedColumns[':p' . $index++]  = 'last_letter';
        }

        $sql = sprintf(
            'INSERT INTO employee (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'uid':
                        $stmt->bindValue($identifier, $this->uid, PDO::PARAM_STR);
                        break;
                    case 'hash':
                        $stmt->bindValue($identifier, $this->hash, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'role_id':
                        $stmt->bindValue($identifier, $this->role_id, PDO::PARAM_INT);
                        break;
                    case 'picture_url':
                        $stmt->bindValue($identifier, $this->picture_url, PDO::PARAM_STR);
                        break;
                    case 'is_grad_advisor':
                        $stmt->bindValue($identifier, (int) $this->is_grad_advisor, PDO::PARAM_INT);
                        break;
                    case 'first_letter':
                        $stmt->bindValue($identifier, $this->first_letter, PDO::PARAM_STR);
                        break;
                    case 'last_letter':
                        $stmt->bindValue($identifier, $this->last_letter, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EmployeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getUid();
                break;
            case 1:
                return $this->getHash();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getRoleId();
                break;
            case 4:
                return $this->getPictureUrl();
                break;
            case 5:
                return $this->getIsGradAdvisor();
                break;
            case 6:
                return $this->getFirstLetter();
                break;
            case 7:
                return $this->getLastLetter();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Employee'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Employee'][$this->hashCode()] = true;
        $keys = EmployeeTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUid(),
            $keys[1] => $this->getHash(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getRoleId(),
            $keys[4] => $this->getPictureUrl(),
            $keys[5] => $this->getIsGradAdvisor(),
            $keys[6] => $this->getFirstLetter(),
            $keys[7] => $this->getLastLetter(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aRole) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'role';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'role';
                        break;
                    default:
                        $key = 'Role';
                }

                $result[$key] = $this->aRole->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collVisits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'visits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'visits';
                        break;
                    default:
                        $key = 'Visits';
                }

                $result[$key] = $this->collVisits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStudents) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'students';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'students';
                        break;
                    default:
                        $key = 'Students';
                }

                $result[$key] = $this->collStudents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTokens) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tokens';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tokens';
                        break;
                    default:
                        $key = 'Tokens';
                }

                $result[$key] = $this->collTokens->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWalkinHours) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'walkinHours';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'walkin_hours';
                        break;
                    default:
                        $key = 'WalkinHours';
                }

                $result[$key] = $this->collWalkinHours->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHours) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hours';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hours';
                        break;
                    default:
                        $key = 'Hours';
                }

                $result[$key] = $this->collHours->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Employee
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EmployeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Employee
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUid($value);
                break;
            case 1:
                $this->setHash($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setRoleId($value);
                break;
            case 4:
                $this->setPictureUrl($value);
                break;
            case 5:
                $this->setIsGradAdvisor($value);
                break;
            case 6:
                $this->setFirstLetter($value);
                break;
            case 7:
                $this->setLastLetter($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this|\Employee
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = EmployeeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setUid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setHash($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setRoleId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPictureUrl($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsGradAdvisor($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFirstLetter($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLastLetter($arr[$keys[7]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Employee The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EmployeeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmployeeTableMap::COL_UID)) {
            $criteria->add(EmployeeTableMap::COL_UID, $this->uid);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_HASH)) {
            $criteria->add(EmployeeTableMap::COL_HASH, $this->hash);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_NAME)) {
            $criteria->add(EmployeeTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ROLE_ID)) {
            $criteria->add(EmployeeTableMap::COL_ROLE_ID, $this->role_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PICTURE_URL)) {
            $criteria->add(EmployeeTableMap::COL_PICTURE_URL, $this->picture_url);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_IS_GRAD_ADVISOR)) {
            $criteria->add(EmployeeTableMap::COL_IS_GRAD_ADVISOR, $this->is_grad_advisor);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_FIRST_LETTER)) {
            $criteria->add(EmployeeTableMap::COL_FIRST_LETTER, $this->first_letter);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_LETTER)) {
            $criteria->add(EmployeeTableMap::COL_LAST_LETTER, $this->last_letter);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildEmployeeQuery::create();
        $criteria->add(EmployeeTableMap::COL_UID, $this->uid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getUid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getUid();
    }

    /**
     * Generic method to set the primary key (uid column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getUid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Employee (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUid($this->getUid());
        $copyObj->setHash($this->getHash());
        $copyObj->setName($this->getName());
        $copyObj->setRoleId($this->getRoleId());
        $copyObj->setPictureUrl($this->getPictureUrl());
        $copyObj->setIsGradAdvisor($this->getIsGradAdvisor());
        $copyObj->setFirstLetter($this->getFirstLetter());
        $copyObj->setLastLetter($this->getLastLetter());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getVisits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVisit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStudents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStudent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTokens() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addToken($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWalkinHours() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWalkinHour($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHours() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHour($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Employee Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildRole object.
     *
     * @param  ChildRole $v
     * @return $this|\Employee The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRole(ChildRole $v = null)
    {
        if ($v === null) {
            $this->setRoleId(NULL);
        } else {
            $this->setRoleId($v->getId());
        }

        $this->aRole = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRole object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRole object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRole The associated ChildRole object.
     * @throws PropelException
     */
    public function getRole(ConnectionInterface $con = null)
    {
        if ($this->aRole === null && ($this->role_id != 0)) {
            $this->aRole = ChildRoleQuery::create()->findPk($this->role_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRole->addEmployees($this);
             */
        }

        return $this->aRole;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Visit' === $relationName) {
            $this->initVisits();
            return;
        }
        if ('Student' === $relationName) {
            $this->initStudents();
            return;
        }
        if ('Token' === $relationName) {
            $this->initTokens();
            return;
        }
        if ('WalkinHour' === $relationName) {
            $this->initWalkinHours();
            return;
        }
        if ('Hour' === $relationName) {
            $this->initHours();
            return;
        }
    }

    /**
     * Clears out the collVisits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVisits()
     */
    public function clearVisits()
    {
        $this->collVisits = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVisits collection loaded partially.
     */
    public function resetPartialVisits($v = true)
    {
        $this->collVisitsPartial = $v;
    }

    /**
     * Initializes the collVisits collection.
     *
     * By default this just sets the collVisits collection to an empty array (like clearcollVisits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVisits($overrideExisting = true)
    {
        if (null !== $this->collVisits && !$overrideExisting) {
            return;
        }

        $collectionClassName = VisitTableMap::getTableMap()->getCollectionClassName();

        $this->collVisits = new $collectionClassName;
        $this->collVisits->setModel('\Visit');
    }

    /**
     * Gets an array of ChildVisit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVisit[] List of ChildVisit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVisit> List of ChildVisit objects
     * @throws PropelException
     */
    public function getVisits(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVisitsPartial && !$this->isNew();
        if (null === $this->collVisits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVisits) {
                    $this->initVisits();
                } else {
                    $collectionClassName = VisitTableMap::getTableMap()->getCollectionClassName();

                    $collVisits = new $collectionClassName;
                    $collVisits->setModel('\Visit');

                    return $collVisits;
                }
            } else {
                $collVisits = ChildVisitQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVisitsPartial && count($collVisits)) {
                        $this->initVisits(false);

                        foreach ($collVisits as $obj) {
                            if (false == $this->collVisits->contains($obj)) {
                                $this->collVisits->append($obj);
                            }
                        }

                        $this->collVisitsPartial = true;
                    }

                    return $collVisits;
                }

                if ($partial && $this->collVisits) {
                    foreach ($this->collVisits as $obj) {
                        if ($obj->isNew()) {
                            $collVisits[] = $obj;
                        }
                    }
                }

                $this->collVisits = $collVisits;
                $this->collVisitsPartial = false;
            }
        }

        return $this->collVisits;
    }

    /**
     * Sets a collection of ChildVisit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $visits A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setVisits(Collection $visits, ConnectionInterface $con = null)
    {
        /** @var ChildVisit[] $visitsToDelete */
        $visitsToDelete = $this->getVisits(new Criteria(), $con)->diff($visits);


        $this->visitsScheduledForDeletion = $visitsToDelete;

        foreach ($visitsToDelete as $visitRemoved) {
            $visitRemoved->setEmployee(null);
        }

        $this->collVisits = null;
        foreach ($visits as $visit) {
            $this->addVisit($visit);
        }

        $this->collVisits = $visits;
        $this->collVisitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Visit objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Visit objects.
     * @throws PropelException
     */
    public function countVisits(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVisitsPartial && !$this->isNew();
        if (null === $this->collVisits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVisits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVisits());
            }

            $query = ChildVisitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collVisits);
    }

    /**
     * Method called to associate a ChildVisit object to this object
     * through the ChildVisit foreign key attribute.
     *
     * @param  ChildVisit $l ChildVisit
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function addVisit(ChildVisit $l)
    {
        if ($this->collVisits === null) {
            $this->initVisits();
            $this->collVisitsPartial = true;
        }

        if (!$this->collVisits->contains($l)) {
            $this->doAddVisit($l);

            if ($this->visitsScheduledForDeletion and $this->visitsScheduledForDeletion->contains($l)) {
                $this->visitsScheduledForDeletion->remove($this->visitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVisit $visit The ChildVisit object to add.
     */
    protected function doAddVisit(ChildVisit $visit)
    {
        $this->collVisits[]= $visit;
        $visit->setEmployee($this);
    }

    /**
     * @param  ChildVisit $visit The ChildVisit object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeVisit(ChildVisit $visit)
    {
        if ($this->getVisits()->contains($visit)) {
            $pos = $this->collVisits->search($visit);
            $this->collVisits->remove($pos);
            if (null === $this->visitsScheduledForDeletion) {
                $this->visitsScheduledForDeletion = clone $this->collVisits;
                $this->visitsScheduledForDeletion->clear();
            }
            $this->visitsScheduledForDeletion[]= clone $visit;
            $visit->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Visits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVisit[] List of ChildVisit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVisit}> List of ChildVisit objects
     */
    public function getVisitsJoinStudent(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVisitQuery::create(null, $criteria);
        $query->joinWith('Student', $joinBehavior);

        return $this->getVisits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Visits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVisit[] List of ChildVisit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVisit}> List of ChildVisit objects
     */
    public function getVisitsJoinReason(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVisitQuery::create(null, $criteria);
        $query->joinWith('Reason', $joinBehavior);

        return $this->getVisits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Visits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVisit[] List of ChildVisit objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVisit}> List of ChildVisit objects
     */
    public function getVisitsJoinModality(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVisitQuery::create(null, $criteria);
        $query->joinWith('Modality', $joinBehavior);

        return $this->getVisits($query, $con);
    }

    /**
     * Clears out the collStudents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStudents()
     */
    public function clearStudents()
    {
        $this->collStudents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collStudents collection loaded partially.
     */
    public function resetPartialStudents($v = true)
    {
        $this->collStudentsPartial = $v;
    }

    /**
     * Initializes the collStudents collection.
     *
     * By default this just sets the collStudents collection to an empty array (like clearcollStudents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStudents($overrideExisting = true)
    {
        if (null !== $this->collStudents && !$overrideExisting) {
            return;
        }

        $collectionClassName = StudentTableMap::getTableMap()->getCollectionClassName();

        $this->collStudents = new $collectionClassName;
        $this->collStudents->setModel('\Student');
    }

    /**
     * Gets an array of ChildStudent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStudent[] List of ChildStudent objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStudent> List of ChildStudent objects
     * @throws PropelException
     */
    public function getStudents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStudentsPartial && !$this->isNew();
        if (null === $this->collStudents || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStudents) {
                    $this->initStudents();
                } else {
                    $collectionClassName = StudentTableMap::getTableMap()->getCollectionClassName();

                    $collStudents = new $collectionClassName;
                    $collStudents->setModel('\Student');

                    return $collStudents;
                }
            } else {
                $collStudents = ChildStudentQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStudentsPartial && count($collStudents)) {
                        $this->initStudents(false);

                        foreach ($collStudents as $obj) {
                            if (false == $this->collStudents->contains($obj)) {
                                $this->collStudents->append($obj);
                            }
                        }

                        $this->collStudentsPartial = true;
                    }

                    return $collStudents;
                }

                if ($partial && $this->collStudents) {
                    foreach ($this->collStudents as $obj) {
                        if ($obj->isNew()) {
                            $collStudents[] = $obj;
                        }
                    }
                }

                $this->collStudents = $collStudents;
                $this->collStudentsPartial = false;
            }
        }

        return $this->collStudents;
    }

    /**
     * Sets a collection of ChildStudent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $students A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setStudents(Collection $students, ConnectionInterface $con = null)
    {
        /** @var ChildStudent[] $studentsToDelete */
        $studentsToDelete = $this->getStudents(new Criteria(), $con)->diff($students);


        $this->studentsScheduledForDeletion = $studentsToDelete;

        foreach ($studentsToDelete as $studentRemoved) {
            $studentRemoved->setEmployee(null);
        }

        $this->collStudents = null;
        foreach ($students as $student) {
            $this->addStudent($student);
        }

        $this->collStudents = $students;
        $this->collStudentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Student objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Student objects.
     * @throws PropelException
     */
    public function countStudents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStudentsPartial && !$this->isNew();
        if (null === $this->collStudents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStudents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStudents());
            }

            $query = ChildStudentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collStudents);
    }

    /**
     * Method called to associate a ChildStudent object to this object
     * through the ChildStudent foreign key attribute.
     *
     * @param  ChildStudent $l ChildStudent
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function addStudent(ChildStudent $l)
    {
        if ($this->collStudents === null) {
            $this->initStudents();
            $this->collStudentsPartial = true;
        }

        if (!$this->collStudents->contains($l)) {
            $this->doAddStudent($l);

            if ($this->studentsScheduledForDeletion and $this->studentsScheduledForDeletion->contains($l)) {
                $this->studentsScheduledForDeletion->remove($this->studentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStudent $student The ChildStudent object to add.
     */
    protected function doAddStudent(ChildStudent $student)
    {
        $this->collStudents[]= $student;
        $student->setEmployee($this);
    }

    /**
     * @param  ChildStudent $student The ChildStudent object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeStudent(ChildStudent $student)
    {
        if ($this->getStudents()->contains($student)) {
            $pos = $this->collStudents->search($student);
            $this->collStudents->remove($pos);
            if (null === $this->studentsScheduledForDeletion) {
                $this->studentsScheduledForDeletion = clone $this->collStudents;
                $this->studentsScheduledForDeletion->clear();
            }
            $this->studentsScheduledForDeletion[]= $student;
            $student->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Students from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStudent[] List of ChildStudent objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStudent}> List of ChildStudent objects
     */
    public function getStudentsJoinMajor(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStudentQuery::create(null, $criteria);
        $query->joinWith('Major', $joinBehavior);

        return $this->getStudents($query, $con);
    }

    /**
     * Clears out the collTokens collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTokens()
     */
    public function clearTokens()
    {
        $this->collTokens = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTokens collection loaded partially.
     */
    public function resetPartialTokens($v = true)
    {
        $this->collTokensPartial = $v;
    }

    /**
     * Initializes the collTokens collection.
     *
     * By default this just sets the collTokens collection to an empty array (like clearcollTokens());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTokens($overrideExisting = true)
    {
        if (null !== $this->collTokens && !$overrideExisting) {
            return;
        }

        $collectionClassName = TokenTableMap::getTableMap()->getCollectionClassName();

        $this->collTokens = new $collectionClassName;
        $this->collTokens->setModel('\Token');
    }

    /**
     * Gets an array of ChildToken objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildToken[] List of ChildToken objects
     * @phpstan-return ObjectCollection&\Traversable<ChildToken> List of ChildToken objects
     * @throws PropelException
     */
    public function getTokens(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTokensPartial && !$this->isNew();
        if (null === $this->collTokens || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTokens) {
                    $this->initTokens();
                } else {
                    $collectionClassName = TokenTableMap::getTableMap()->getCollectionClassName();

                    $collTokens = new $collectionClassName;
                    $collTokens->setModel('\Token');

                    return $collTokens;
                }
            } else {
                $collTokens = ChildTokenQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTokensPartial && count($collTokens)) {
                        $this->initTokens(false);

                        foreach ($collTokens as $obj) {
                            if (false == $this->collTokens->contains($obj)) {
                                $this->collTokens->append($obj);
                            }
                        }

                        $this->collTokensPartial = true;
                    }

                    return $collTokens;
                }

                if ($partial && $this->collTokens) {
                    foreach ($this->collTokens as $obj) {
                        if ($obj->isNew()) {
                            $collTokens[] = $obj;
                        }
                    }
                }

                $this->collTokens = $collTokens;
                $this->collTokensPartial = false;
            }
        }

        return $this->collTokens;
    }

    /**
     * Sets a collection of ChildToken objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $tokens A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setTokens(Collection $tokens, ConnectionInterface $con = null)
    {
        /** @var ChildToken[] $tokensToDelete */
        $tokensToDelete = $this->getTokens(new Criteria(), $con)->diff($tokens);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->tokensScheduledForDeletion = clone $tokensToDelete;

        foreach ($tokensToDelete as $tokenRemoved) {
            $tokenRemoved->setEmployee(null);
        }

        $this->collTokens = null;
        foreach ($tokens as $token) {
            $this->addToken($token);
        }

        $this->collTokens = $tokens;
        $this->collTokensPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Token objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Token objects.
     * @throws PropelException
     */
    public function countTokens(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTokensPartial && !$this->isNew();
        if (null === $this->collTokens || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTokens) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTokens());
            }

            $query = ChildTokenQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collTokens);
    }

    /**
     * Method called to associate a ChildToken object to this object
     * through the ChildToken foreign key attribute.
     *
     * @param  ChildToken $l ChildToken
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function addToken(ChildToken $l)
    {
        if ($this->collTokens === null) {
            $this->initTokens();
            $this->collTokensPartial = true;
        }

        if (!$this->collTokens->contains($l)) {
            $this->doAddToken($l);

            if ($this->tokensScheduledForDeletion and $this->tokensScheduledForDeletion->contains($l)) {
                $this->tokensScheduledForDeletion->remove($this->tokensScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildToken $token The ChildToken object to add.
     */
    protected function doAddToken(ChildToken $token)
    {
        $this->collTokens[]= $token;
        $token->setEmployee($this);
    }

    /**
     * @param  ChildToken $token The ChildToken object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeToken(ChildToken $token)
    {
        if ($this->getTokens()->contains($token)) {
            $pos = $this->collTokens->search($token);
            $this->collTokens->remove($pos);
            if (null === $this->tokensScheduledForDeletion) {
                $this->tokensScheduledForDeletion = clone $this->collTokens;
                $this->tokensScheduledForDeletion->clear();
            }
            $this->tokensScheduledForDeletion[]= clone $token;
            $token->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collWalkinHours collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addWalkinHours()
     */
    public function clearWalkinHours()
    {
        $this->collWalkinHours = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collWalkinHours collection loaded partially.
     */
    public function resetPartialWalkinHours($v = true)
    {
        $this->collWalkinHoursPartial = $v;
    }

    /**
     * Initializes the collWalkinHours collection.
     *
     * By default this just sets the collWalkinHours collection to an empty array (like clearcollWalkinHours());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWalkinHours($overrideExisting = true)
    {
        if (null !== $this->collWalkinHours && !$overrideExisting) {
            return;
        }

        $collectionClassName = WalkinHourTableMap::getTableMap()->getCollectionClassName();

        $this->collWalkinHours = new $collectionClassName;
        $this->collWalkinHours->setModel('\WalkinHour');
    }

    /**
     * Gets an array of ChildWalkinHour objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWalkinHour[] List of ChildWalkinHour objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWalkinHour> List of ChildWalkinHour objects
     * @throws PropelException
     */
    public function getWalkinHours(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collWalkinHoursPartial && !$this->isNew();
        if (null === $this->collWalkinHours || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWalkinHours) {
                    $this->initWalkinHours();
                } else {
                    $collectionClassName = WalkinHourTableMap::getTableMap()->getCollectionClassName();

                    $collWalkinHours = new $collectionClassName;
                    $collWalkinHours->setModel('\WalkinHour');

                    return $collWalkinHours;
                }
            } else {
                $collWalkinHours = ChildWalkinHourQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWalkinHoursPartial && count($collWalkinHours)) {
                        $this->initWalkinHours(false);

                        foreach ($collWalkinHours as $obj) {
                            if (false == $this->collWalkinHours->contains($obj)) {
                                $this->collWalkinHours->append($obj);
                            }
                        }

                        $this->collWalkinHoursPartial = true;
                    }

                    return $collWalkinHours;
                }

                if ($partial && $this->collWalkinHours) {
                    foreach ($this->collWalkinHours as $obj) {
                        if ($obj->isNew()) {
                            $collWalkinHours[] = $obj;
                        }
                    }
                }

                $this->collWalkinHours = $collWalkinHours;
                $this->collWalkinHoursPartial = false;
            }
        }

        return $this->collWalkinHours;
    }

    /**
     * Sets a collection of ChildWalkinHour objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $walkinHours A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setWalkinHours(Collection $walkinHours, ConnectionInterface $con = null)
    {
        /** @var ChildWalkinHour[] $walkinHoursToDelete */
        $walkinHoursToDelete = $this->getWalkinHours(new Criteria(), $con)->diff($walkinHours);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->walkinHoursScheduledForDeletion = clone $walkinHoursToDelete;

        foreach ($walkinHoursToDelete as $walkinHourRemoved) {
            $walkinHourRemoved->setEmployee(null);
        }

        $this->collWalkinHours = null;
        foreach ($walkinHours as $walkinHour) {
            $this->addWalkinHour($walkinHour);
        }

        $this->collWalkinHours = $walkinHours;
        $this->collWalkinHoursPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WalkinHour objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related WalkinHour objects.
     * @throws PropelException
     */
    public function countWalkinHours(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collWalkinHoursPartial && !$this->isNew();
        if (null === $this->collWalkinHours || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWalkinHours) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWalkinHours());
            }

            $query = ChildWalkinHourQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collWalkinHours);
    }

    /**
     * Method called to associate a ChildWalkinHour object to this object
     * through the ChildWalkinHour foreign key attribute.
     *
     * @param  ChildWalkinHour $l ChildWalkinHour
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function addWalkinHour(ChildWalkinHour $l)
    {
        if ($this->collWalkinHours === null) {
            $this->initWalkinHours();
            $this->collWalkinHoursPartial = true;
        }

        if (!$this->collWalkinHours->contains($l)) {
            $this->doAddWalkinHour($l);

            if ($this->walkinHoursScheduledForDeletion and $this->walkinHoursScheduledForDeletion->contains($l)) {
                $this->walkinHoursScheduledForDeletion->remove($this->walkinHoursScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWalkinHour $walkinHour The ChildWalkinHour object to add.
     */
    protected function doAddWalkinHour(ChildWalkinHour $walkinHour)
    {
        $this->collWalkinHours[]= $walkinHour;
        $walkinHour->setEmployee($this);
    }

    /**
     * @param  ChildWalkinHour $walkinHour The ChildWalkinHour object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeWalkinHour(ChildWalkinHour $walkinHour)
    {
        if ($this->getWalkinHours()->contains($walkinHour)) {
            $pos = $this->collWalkinHours->search($walkinHour);
            $this->collWalkinHours->remove($pos);
            if (null === $this->walkinHoursScheduledForDeletion) {
                $this->walkinHoursScheduledForDeletion = clone $this->collWalkinHours;
                $this->walkinHoursScheduledForDeletion->clear();
            }
            $this->walkinHoursScheduledForDeletion[]= clone $walkinHour;
            $walkinHour->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collHours collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addHours()
     */
    public function clearHours()
    {
        $this->collHours = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collHours collection loaded partially.
     */
    public function resetPartialHours($v = true)
    {
        $this->collHoursPartial = $v;
    }

    /**
     * Initializes the collHours collection.
     *
     * By default this just sets the collHours collection to an empty array (like clearcollHours());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHours($overrideExisting = true)
    {
        if (null !== $this->collHours && !$overrideExisting) {
            return;
        }

        $collectionClassName = HourTableMap::getTableMap()->getCollectionClassName();

        $this->collHours = new $collectionClassName;
        $this->collHours->setModel('\Hour');
    }

    /**
     * Gets an array of ChildHour objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHour[] List of ChildHour objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHour> List of ChildHour objects
     * @throws PropelException
     */
    public function getHours(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collHoursPartial && !$this->isNew();
        if (null === $this->collHours || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHours) {
                    $this->initHours();
                } else {
                    $collectionClassName = HourTableMap::getTableMap()->getCollectionClassName();

                    $collHours = new $collectionClassName;
                    $collHours->setModel('\Hour');

                    return $collHours;
                }
            } else {
                $collHours = ChildHourQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHoursPartial && count($collHours)) {
                        $this->initHours(false);

                        foreach ($collHours as $obj) {
                            if (false == $this->collHours->contains($obj)) {
                                $this->collHours->append($obj);
                            }
                        }

                        $this->collHoursPartial = true;
                    }

                    return $collHours;
                }

                if ($partial && $this->collHours) {
                    foreach ($this->collHours as $obj) {
                        if ($obj->isNew()) {
                            $collHours[] = $obj;
                        }
                    }
                }

                $this->collHours = $collHours;
                $this->collHoursPartial = false;
            }
        }

        return $this->collHours;
    }

    /**
     * Sets a collection of ChildHour objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $hours A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function setHours(Collection $hours, ConnectionInterface $con = null)
    {
        /** @var ChildHour[] $hoursToDelete */
        $hoursToDelete = $this->getHours(new Criteria(), $con)->diff($hours);


        $this->hoursScheduledForDeletion = $hoursToDelete;

        foreach ($hoursToDelete as $hourRemoved) {
            $hourRemoved->setEmployee(null);
        }

        $this->collHours = null;
        foreach ($hours as $hour) {
            $this->addHour($hour);
        }

        $this->collHours = $hours;
        $this->collHoursPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Hour objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Hour objects.
     * @throws PropelException
     */
    public function countHours(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collHoursPartial && !$this->isNew();
        if (null === $this->collHours || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHours) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHours());
            }

            $query = ChildHourQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collHours);
    }

    /**
     * Method called to associate a ChildHour object to this object
     * through the ChildHour foreign key attribute.
     *
     * @param  ChildHour $l ChildHour
     * @return $this|\Employee The current object (for fluent API support)
     */
    public function addHour(ChildHour $l)
    {
        if ($this->collHours === null) {
            $this->initHours();
            $this->collHoursPartial = true;
        }

        if (!$this->collHours->contains($l)) {
            $this->doAddHour($l);

            if ($this->hoursScheduledForDeletion and $this->hoursScheduledForDeletion->contains($l)) {
                $this->hoursScheduledForDeletion->remove($this->hoursScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHour $hour The ChildHour object to add.
     */
    protected function doAddHour(ChildHour $hour)
    {
        $this->collHours[]= $hour;
        $hour->setEmployee($this);
    }

    /**
     * @param  ChildHour $hour The ChildHour object to remove.
     * @return $this|ChildEmployee The current object (for fluent API support)
     */
    public function removeHour(ChildHour $hour)
    {
        if ($this->getHours()->contains($hour)) {
            $pos = $this->collHours->search($hour);
            $this->collHours->remove($pos);
            if (null === $this->hoursScheduledForDeletion) {
                $this->hoursScheduledForDeletion = clone $this->collHours;
                $this->hoursScheduledForDeletion->clear();
            }
            $this->hoursScheduledForDeletion[]= clone $hour;
            $hour->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aRole) {
            $this->aRole->removeEmployee($this);
        }
        $this->uid = null;
        $this->hash = null;
        $this->name = null;
        $this->role_id = null;
        $this->picture_url = null;
        $this->is_grad_advisor = null;
        $this->first_letter = null;
        $this->last_letter = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collVisits) {
                foreach ($this->collVisits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStudents) {
                foreach ($this->collStudents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTokens) {
                foreach ($this->collTokens as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWalkinHours) {
                foreach ($this->collWalkinHours as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHours) {
                foreach ($this->collHours as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collVisits = null;
        $this->collStudents = null;
        $this->collTokens = null;
        $this->collWalkinHours = null;
        $this->collHours = null;
        $this->aRole = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmployeeTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
