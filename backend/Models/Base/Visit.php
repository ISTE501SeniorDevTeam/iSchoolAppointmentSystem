<?php

namespace Base;

use \Employee as ChildEmployee;
use \EmployeeQuery as ChildEmployeeQuery;
use \Modality as ChildModality;
use \ModalityQuery as ChildModalityQuery;
use \Reason as ChildReason;
use \ReasonQuery as ChildReasonQuery;
use \Student as ChildStudent;
use \StudentQuery as ChildStudentQuery;
use \VisitQuery as ChildVisitQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\VisitTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'visit' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Visit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\VisitTableMap';


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
     * The value for the id field.
     *
     * @var        string
     */
    protected $id;

    /**
     * The value for the advisor_id field.
     *
     * @var        string
     */
    protected $advisor_id;

    /**
     * The value for the student_id field.
     *
     * @var        string
     */
    protected $student_id;

    /**
     * The value for the reason_id field.
     *
     * @var        int
     */
    protected $reason_id;

    /**
     * The value for the modality_id field.
     *
     * @var        int
     */
    protected $modality_id;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the invited_at field.
     *
     * @var        DateTime|null
     */
    protected $invited_at;

    /**
     * The value for the complete_at field.
     *
     * @var        DateTime|null
     */
    protected $complete_at;

    /**
     * The value for the position field.
     *
     * @var        int|null
     */
    protected $position;

    /**
     * The value for the custom_reason field.
     *
     * @var        string|null
     */
    protected $custom_reason;

    /**
     * @var        ChildStudent
     */
    protected $aStudent;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildReason
     */
    protected $aReason;

    /**
     * @var        ChildModality
     */
    protected $aModality;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Visit object.
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
     * Compares this with another <code>Visit</code> instance.  If
     * <code>obj</code> is an instance of <code>Visit</code>, delegates to
     * <code>equals(Visit)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [advisor_id] column value.
     *
     * @return string
     */
    public function getAdvisorId()
    {
        return $this->advisor_id;
    }

    /**
     * Get the [student_id] column value.
     *
     * @return string
     */
    public function getStudentId()
    {
        return $this->student_id;
    }

    /**
     * Get the [reason_id] column value.
     *
     * @return int
     */
    public function getReasonId()
    {
        return $this->reason_id;
    }

    /**
     * Get the [modality_id] column value.
     *
     * @return int
     */
    public function getModalityId()
    {
        return $this->modality_id;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [invited_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getInvitedAt($format = null)
    {
        if ($format === null) {
            return $this->invited_at;
        } else {
            return $this->invited_at instanceof \DateTimeInterface ? $this->invited_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [complete_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCompleteAt($format = null)
    {
        if ($format === null) {
            return $this->complete_at;
        } else {
            return $this->complete_at instanceof \DateTimeInterface ? $this->complete_at->format($format) : null;
        }
    }

    /**
     * Get the [position] column value.
     *
     * @return int|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get the [custom_reason] column value.
     *
     * @return string|null
     */
    public function getCustomReason()
    {
        return $this->custom_reason;
    }

    /**
     * Set the value of [id] column.
     *
     * @param string $v New value
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[VisitTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [advisor_id] column.
     *
     * @param string $v New value
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setAdvisorId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->advisor_id !== $v) {
            $this->advisor_id = $v;
            $this->modifiedColumns[VisitTableMap::COL_ADVISOR_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getUid() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    } // setAdvisorId()

    /**
     * Set the value of [student_id] column.
     *
     * @param string $v New value
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setStudentId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->student_id !== $v) {
            $this->student_id = $v;
            $this->modifiedColumns[VisitTableMap::COL_STUDENT_ID] = true;
        }

        if ($this->aStudent !== null && $this->aStudent->getUid() !== $v) {
            $this->aStudent = null;
        }

        return $this;
    } // setStudentId()

    /**
     * Set the value of [reason_id] column.
     *
     * @param int $v New value
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setReasonId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->reason_id !== $v) {
            $this->reason_id = $v;
            $this->modifiedColumns[VisitTableMap::COL_REASON_ID] = true;
        }

        if ($this->aReason !== null && $this->aReason->getId() !== $v) {
            $this->aReason = null;
        }

        return $this;
    } // setReasonId()

    /**
     * Set the value of [modality_id] column.
     *
     * @param int $v New value
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setModalityId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->modality_id !== $v) {
            $this->modality_id = $v;
            $this->modifiedColumns[VisitTableMap::COL_MODALITY_ID] = true;
        }

        if ($this->aModality !== null && $this->aModality->getId() !== $v) {
            $this->aModality = null;
        }

        return $this;
    } // setModalityId()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VisitTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [invited_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setInvitedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->invited_at !== null || $dt !== null) {
            if ($this->invited_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->invited_at->format("Y-m-d H:i:s.u")) {
                $this->invited_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VisitTableMap::COL_INVITED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setInvitedAt()

    /**
     * Sets the value of [complete_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setCompleteAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->complete_at !== null || $dt !== null) {
            if ($this->complete_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->complete_at->format("Y-m-d H:i:s.u")) {
                $this->complete_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VisitTableMap::COL_COMPLETE_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCompleteAt()

    /**
     * Set the value of [position] column.
     *
     * @param int|null $v New value
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[VisitTableMap::COL_POSITION] = true;
        }

        return $this;
    } // setPosition()

    /**
     * Set the value of [custom_reason] column.
     *
     * @param string|null $v New value
     * @return $this|\Visit The current object (for fluent API support)
     */
    public function setCustomReason($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->custom_reason !== $v) {
            $this->custom_reason = $v;
            $this->modifiedColumns[VisitTableMap::COL_CUSTOM_REASON] = true;
        }

        return $this;
    } // setCustomReason()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VisitTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VisitTableMap::translateFieldName('AdvisorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->advisor_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VisitTableMap::translateFieldName('StudentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->student_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : VisitTableMap::translateFieldName('ReasonId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reason_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : VisitTableMap::translateFieldName('ModalityId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->modality_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : VisitTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : VisitTableMap::translateFieldName('InvitedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->invited_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : VisitTableMap::translateFieldName('CompleteAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->complete_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : VisitTableMap::translateFieldName('Position', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : VisitTableMap::translateFieldName('CustomReason', TableMap::TYPE_PHPNAME, $indexType)];
            $this->custom_reason = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = VisitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Visit'), 0, $e);
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
        if ($this->aEmployee !== null && $this->advisor_id !== $this->aEmployee->getUid()) {
            $this->aEmployee = null;
        }
        if ($this->aStudent !== null && $this->student_id !== $this->aStudent->getUid()) {
            $this->aStudent = null;
        }
        if ($this->aReason !== null && $this->reason_id !== $this->aReason->getId()) {
            $this->aReason = null;
        }
        if ($this->aModality !== null && $this->modality_id !== $this->aModality->getId()) {
            $this->aModality = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(VisitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVisitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aStudent = null;
            $this->aEmployee = null;
            $this->aReason = null;
            $this->aModality = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Visit::setDeleted()
     * @see Visit::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VisitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVisitQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(VisitTableMap::DATABASE_NAME);
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
                VisitTableMap::addInstanceToPool($this);
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

            if ($this->aStudent !== null) {
                if ($this->aStudent->isModified() || $this->aStudent->isNew()) {
                    $affectedRows += $this->aStudent->save($con);
                }
                $this->setStudent($this->aStudent);
            }

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aReason !== null) {
                if ($this->aReason->isModified() || $this->aReason->isNew()) {
                    $affectedRows += $this->aReason->save($con);
                }
                $this->setReason($this->aReason);
            }

            if ($this->aModality !== null) {
                if ($this->aModality->isModified() || $this->aModality->isNew()) {
                    $affectedRows += $this->aModality->save($con);
                }
                $this->setModality($this->aModality);
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
        if ($this->isColumnModified(VisitTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(VisitTableMap::COL_ADVISOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'advisor_id';
        }
        if ($this->isColumnModified(VisitTableMap::COL_STUDENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'student_id';
        }
        if ($this->isColumnModified(VisitTableMap::COL_REASON_ID)) {
            $modifiedColumns[':p' . $index++]  = 'reason_id';
        }
        if ($this->isColumnModified(VisitTableMap::COL_MODALITY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'modality_id';
        }
        if ($this->isColumnModified(VisitTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(VisitTableMap::COL_INVITED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'invited_at';
        }
        if ($this->isColumnModified(VisitTableMap::COL_COMPLETE_AT)) {
            $modifiedColumns[':p' . $index++]  = 'complete_at';
        }
        if ($this->isColumnModified(VisitTableMap::COL_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'position';
        }
        if ($this->isColumnModified(VisitTableMap::COL_CUSTOM_REASON)) {
            $modifiedColumns[':p' . $index++]  = 'custom_reason';
        }

        $sql = sprintf(
            'INSERT INTO visit (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_STR);
                        break;
                    case 'advisor_id':
                        $stmt->bindValue($identifier, $this->advisor_id, PDO::PARAM_STR);
                        break;
                    case 'student_id':
                        $stmt->bindValue($identifier, $this->student_id, PDO::PARAM_STR);
                        break;
                    case 'reason_id':
                        $stmt->bindValue($identifier, $this->reason_id, PDO::PARAM_INT);
                        break;
                    case 'modality_id':
                        $stmt->bindValue($identifier, $this->modality_id, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'invited_at':
                        $stmt->bindValue($identifier, $this->invited_at ? $this->invited_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'complete_at':
                        $stmt->bindValue($identifier, $this->complete_at ? $this->complete_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'position':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_INT);
                        break;
                    case 'custom_reason':
                        $stmt->bindValue($identifier, $this->custom_reason, PDO::PARAM_STR);
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
        $pos = VisitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getId();
                break;
            case 1:
                return $this->getAdvisorId();
                break;
            case 2:
                return $this->getStudentId();
                break;
            case 3:
                return $this->getReasonId();
                break;
            case 4:
                return $this->getModalityId();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
                return $this->getInvitedAt();
                break;
            case 7:
                return $this->getCompleteAt();
                break;
            case 8:
                return $this->getPosition();
                break;
            case 9:
                return $this->getCustomReason();
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

        if (isset($alreadyDumpedObjects['Visit'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Visit'][$this->hashCode()] = true;
        $keys = VisitTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAdvisorId(),
            $keys[2] => $this->getStudentId(),
            $keys[3] => $this->getReasonId(),
            $keys[4] => $this->getModalityId(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getInvitedAt(),
            $keys[7] => $this->getCompleteAt(),
            $keys[8] => $this->getPosition(),
            $keys[9] => $this->getCustomReason(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aStudent) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'student';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'student';
                        break;
                    default:
                        $key = 'Student';
                }

                $result[$key] = $this->aStudent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEmployee) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployee->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aReason) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reason';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reason';
                        break;
                    default:
                        $key = 'Reason';
                }

                $result[$key] = $this->aReason->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aModality) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'modality';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'modality';
                        break;
                    default:
                        $key = 'Modality';
                }

                $result[$key] = $this->aModality->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Visit
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VisitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Visit
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setAdvisorId($value);
                break;
            case 2:
                $this->setStudentId($value);
                break;
            case 3:
                $this->setReasonId($value);
                break;
            case 4:
                $this->setModalityId($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
                $this->setInvitedAt($value);
                break;
            case 7:
                $this->setCompleteAt($value);
                break;
            case 8:
                $this->setPosition($value);
                break;
            case 9:
                $this->setCustomReason($value);
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
     * @return     $this|\Visit
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = VisitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAdvisorId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStudentId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setReasonId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setModalityId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setInvitedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCompleteAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPosition($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCustomReason($arr[$keys[9]]);
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
     * @return $this|\Visit The current object, for fluid interface
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
        $criteria = new Criteria(VisitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VisitTableMap::COL_ID)) {
            $criteria->add(VisitTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(VisitTableMap::COL_ADVISOR_ID)) {
            $criteria->add(VisitTableMap::COL_ADVISOR_ID, $this->advisor_id);
        }
        if ($this->isColumnModified(VisitTableMap::COL_STUDENT_ID)) {
            $criteria->add(VisitTableMap::COL_STUDENT_ID, $this->student_id);
        }
        if ($this->isColumnModified(VisitTableMap::COL_REASON_ID)) {
            $criteria->add(VisitTableMap::COL_REASON_ID, $this->reason_id);
        }
        if ($this->isColumnModified(VisitTableMap::COL_MODALITY_ID)) {
            $criteria->add(VisitTableMap::COL_MODALITY_ID, $this->modality_id);
        }
        if ($this->isColumnModified(VisitTableMap::COL_CREATED_AT)) {
            $criteria->add(VisitTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(VisitTableMap::COL_INVITED_AT)) {
            $criteria->add(VisitTableMap::COL_INVITED_AT, $this->invited_at);
        }
        if ($this->isColumnModified(VisitTableMap::COL_COMPLETE_AT)) {
            $criteria->add(VisitTableMap::COL_COMPLETE_AT, $this->complete_at);
        }
        if ($this->isColumnModified(VisitTableMap::COL_POSITION)) {
            $criteria->add(VisitTableMap::COL_POSITION, $this->position);
        }
        if ($this->isColumnModified(VisitTableMap::COL_CUSTOM_REASON)) {
            $criteria->add(VisitTableMap::COL_CUSTOM_REASON, $this->custom_reason);
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
        $criteria = ChildVisitQuery::create();
        $criteria->add(VisitTableMap::COL_ID, $this->id);

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
        $validPk = null !== $this->getId();

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
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Visit (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setId($this->getId());
        $copyObj->setAdvisorId($this->getAdvisorId());
        $copyObj->setStudentId($this->getStudentId());
        $copyObj->setReasonId($this->getReasonId());
        $copyObj->setModalityId($this->getModalityId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setInvitedAt($this->getInvitedAt());
        $copyObj->setCompleteAt($this->getCompleteAt());
        $copyObj->setPosition($this->getPosition());
        $copyObj->setCustomReason($this->getCustomReason());
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
     * @return \Visit Clone of current object.
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
     * Declares an association between this object and a ChildStudent object.
     *
     * @param  ChildStudent $v
     * @return $this|\Visit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStudent(ChildStudent $v = null)
    {
        if ($v === null) {
            $this->setStudentId(NULL);
        } else {
            $this->setStudentId($v->getUid());
        }

        $this->aStudent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStudent object, it will not be re-added.
        if ($v !== null) {
            $v->addVisit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStudent object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildStudent The associated ChildStudent object.
     * @throws PropelException
     */
    public function getStudent(ConnectionInterface $con = null)
    {
        if ($this->aStudent === null && (($this->student_id !== "" && $this->student_id !== null))) {
            $this->aStudent = ChildStudentQuery::create()->findPk($this->student_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStudent->addVisits($this);
             */
        }

        return $this->aStudent;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param  ChildEmployee $v
     * @return $this|\Visit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEmployee(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setAdvisorId(NULL);
        } else {
            $this->setAdvisorId($v->getUid());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addVisit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee The associated ChildEmployee object.
     * @throws PropelException
     */
    public function getEmployee(ConnectionInterface $con = null)
    {
        if ($this->aEmployee === null && (($this->advisor_id !== "" && $this->advisor_id !== null))) {
            $this->aEmployee = ChildEmployeeQuery::create()->findPk($this->advisor_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployee->addVisits($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildReason object.
     *
     * @param  ChildReason $v
     * @return $this|\Visit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setReason(ChildReason $v = null)
    {
        if ($v === null) {
            $this->setReasonId(NULL);
        } else {
            $this->setReasonId($v->getId());
        }

        $this->aReason = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildReason object, it will not be re-added.
        if ($v !== null) {
            $v->addVisit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildReason object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildReason The associated ChildReason object.
     * @throws PropelException
     */
    public function getReason(ConnectionInterface $con = null)
    {
        if ($this->aReason === null && ($this->reason_id != 0)) {
            $this->aReason = ChildReasonQuery::create()->findPk($this->reason_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aReason->addVisits($this);
             */
        }

        return $this->aReason;
    }

    /**
     * Declares an association between this object and a ChildModality object.
     *
     * @param  ChildModality $v
     * @return $this|\Visit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setModality(ChildModality $v = null)
    {
        if ($v === null) {
            $this->setModalityId(NULL);
        } else {
            $this->setModalityId($v->getId());
        }

        $this->aModality = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildModality object, it will not be re-added.
        if ($v !== null) {
            $v->addVisit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildModality object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildModality The associated ChildModality object.
     * @throws PropelException
     */
    public function getModality(ConnectionInterface $con = null)
    {
        if ($this->aModality === null && ($this->modality_id != 0)) {
            $this->aModality = ChildModalityQuery::create()->findPk($this->modality_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aModality->addVisits($this);
             */
        }

        return $this->aModality;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aStudent) {
            $this->aStudent->removeVisit($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeVisit($this);
        }
        if (null !== $this->aReason) {
            $this->aReason->removeVisit($this);
        }
        if (null !== $this->aModality) {
            $this->aModality->removeVisit($this);
        }
        $this->id = null;
        $this->advisor_id = null;
        $this->student_id = null;
        $this->reason_id = null;
        $this->modality_id = null;
        $this->created_at = null;
        $this->invited_at = null;
        $this->complete_at = null;
        $this->position = null;
        $this->custom_reason = null;
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
        } // if ($deep)

        $this->aStudent = null;
        $this->aEmployee = null;
        $this->aReason = null;
        $this->aModality = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VisitTableMap::DEFAULT_STRING_FORMAT);
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
