<?php

namespace Base;

use \Hour as ChildHour;
use \HourQuery as ChildHourQuery;
use \Exception;
use \PDO;
use Map\HourTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'hour' table.
 *
 *
 *
 * @method     ChildHourQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildHourQuery orderByAdvisorId($order = Criteria::ASC) Order by the advisor_id column
 * @method     ChildHourQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildHourQuery orderByStartRecurrence($order = Criteria::ASC) Order by the start_recurrence column
 * @method     ChildHourQuery orderByEndRecurrence($order = Criteria::ASC) Order by the end_recurrence column
 * @method     ChildHourQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     ChildHourQuery orderByEndTime($order = Criteria::ASC) Order by the end_time column
 * @method     ChildHourQuery orderByDayOfWeek($order = Criteria::ASC) Order by the day_of_week column
 *
 * @method     ChildHourQuery groupById() Group by the id column
 * @method     ChildHourQuery groupByAdvisorId() Group by the advisor_id column
 * @method     ChildHourQuery groupByDate() Group by the date column
 * @method     ChildHourQuery groupByStartRecurrence() Group by the start_recurrence column
 * @method     ChildHourQuery groupByEndRecurrence() Group by the end_recurrence column
 * @method     ChildHourQuery groupByStartTime() Group by the start_time column
 * @method     ChildHourQuery groupByEndTime() Group by the end_time column
 * @method     ChildHourQuery groupByDayOfWeek() Group by the day_of_week column
 *
 * @method     ChildHourQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHourQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHourQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHourQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHourQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHourQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHourQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildHourQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildHourQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildHourQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildHourQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildHourQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildHourQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHour|null findOne(ConnectionInterface $con = null) Return the first ChildHour matching the query
 * @method     ChildHour findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHour matching the query, or a new ChildHour object populated from the query conditions when no match is found
 *
 * @method     ChildHour|null findOneById(int $id) Return the first ChildHour filtered by the id column
 * @method     ChildHour|null findOneByAdvisorId(string $advisor_id) Return the first ChildHour filtered by the advisor_id column
 * @method     ChildHour|null findOneByDate(string $date) Return the first ChildHour filtered by the date column
 * @method     ChildHour|null findOneByStartRecurrence(string $start_recurrence) Return the first ChildHour filtered by the start_recurrence column
 * @method     ChildHour|null findOneByEndRecurrence(string $end_recurrence) Return the first ChildHour filtered by the end_recurrence column
 * @method     ChildHour|null findOneByStartTime(string $start_time) Return the first ChildHour filtered by the start_time column
 * @method     ChildHour|null findOneByEndTime(string $end_time) Return the first ChildHour filtered by the end_time column
 * @method     ChildHour|null findOneByDayOfWeek(string $day_of_week) Return the first ChildHour filtered by the day_of_week column *

 * @method     ChildHour requirePk($key, ConnectionInterface $con = null) Return the ChildHour by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOne(ConnectionInterface $con = null) Return the first ChildHour matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHour requireOneById(int $id) Return the first ChildHour filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOneByAdvisorId(string $advisor_id) Return the first ChildHour filtered by the advisor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOneByDate(string $date) Return the first ChildHour filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOneByStartRecurrence(string $start_recurrence) Return the first ChildHour filtered by the start_recurrence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOneByEndRecurrence(string $end_recurrence) Return the first ChildHour filtered by the end_recurrence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOneByStartTime(string $start_time) Return the first ChildHour filtered by the start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOneByEndTime(string $end_time) Return the first ChildHour filtered by the end_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHour requireOneByDayOfWeek(string $day_of_week) Return the first ChildHour filtered by the day_of_week column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHour[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHour objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildHour> find(ConnectionInterface $con = null) Return ChildHour objects based on current ModelCriteria
 * @method     ChildHour[]|ObjectCollection findById(int $id) Return ChildHour objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findById(int $id) Return ChildHour objects filtered by the id column
 * @method     ChildHour[]|ObjectCollection findByAdvisorId(string $advisor_id) Return ChildHour objects filtered by the advisor_id column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findByAdvisorId(string $advisor_id) Return ChildHour objects filtered by the advisor_id column
 * @method     ChildHour[]|ObjectCollection findByDate(string $date) Return ChildHour objects filtered by the date column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findByDate(string $date) Return ChildHour objects filtered by the date column
 * @method     ChildHour[]|ObjectCollection findByStartRecurrence(string $start_recurrence) Return ChildHour objects filtered by the start_recurrence column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findByStartRecurrence(string $start_recurrence) Return ChildHour objects filtered by the start_recurrence column
 * @method     ChildHour[]|ObjectCollection findByEndRecurrence(string $end_recurrence) Return ChildHour objects filtered by the end_recurrence column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findByEndRecurrence(string $end_recurrence) Return ChildHour objects filtered by the end_recurrence column
 * @method     ChildHour[]|ObjectCollection findByStartTime(string $start_time) Return ChildHour objects filtered by the start_time column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findByStartTime(string $start_time) Return ChildHour objects filtered by the start_time column
 * @method     ChildHour[]|ObjectCollection findByEndTime(string $end_time) Return ChildHour objects filtered by the end_time column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findByEndTime(string $end_time) Return ChildHour objects filtered by the end_time column
 * @method     ChildHour[]|ObjectCollection findByDayOfWeek(string $day_of_week) Return ChildHour objects filtered by the day_of_week column
 * @psalm-method ObjectCollection&\Traversable<ChildHour> findByDayOfWeek(string $day_of_week) Return ChildHour objects filtered by the day_of_week column
 * @method     ChildHour[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHour> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HourQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\HourQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Hour', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHourQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHourQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHourQuery) {
            return $criteria;
        }
        $query = new ChildHourQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildHour|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HourTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HourTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHour A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, advisor_id, date, start_recurrence, end_recurrence, start_time, end_time, day_of_week FROM hour WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildHour $obj */
            $obj = new ChildHour();
            $obj->hydrate($row);
            HourTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildHour|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HourTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HourTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(HourTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HourTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the advisor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAdvisorId('fooValue');   // WHERE advisor_id = 'fooValue'
     * $query->filterByAdvisorId('%fooValue%', Criteria::LIKE); // WHERE advisor_id LIKE '%fooValue%'
     * $query->filterByAdvisorId(['foo', 'bar']); // WHERE advisor_id IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $advisorId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByAdvisorId($advisorId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($advisorId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_ADVISOR_ID, $advisorId, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(HourTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(HourTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the start_recurrence column
     *
     * Example usage:
     * <code>
     * $query->filterByStartRecurrence('2011-03-14'); // WHERE start_recurrence = '2011-03-14'
     * $query->filterByStartRecurrence('now'); // WHERE start_recurrence = '2011-03-14'
     * $query->filterByStartRecurrence(array('max' => 'yesterday')); // WHERE start_recurrence > '2011-03-13'
     * </code>
     *
     * @param     mixed $startRecurrence The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByStartRecurrence($startRecurrence = null, $comparison = null)
    {
        if (is_array($startRecurrence)) {
            $useMinMax = false;
            if (isset($startRecurrence['min'])) {
                $this->addUsingAlias(HourTableMap::COL_START_RECURRENCE, $startRecurrence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startRecurrence['max'])) {
                $this->addUsingAlias(HourTableMap::COL_START_RECURRENCE, $startRecurrence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_START_RECURRENCE, $startRecurrence, $comparison);
    }

    /**
     * Filter the query on the end_recurrence column
     *
     * Example usage:
     * <code>
     * $query->filterByEndRecurrence('2011-03-14'); // WHERE end_recurrence = '2011-03-14'
     * $query->filterByEndRecurrence('now'); // WHERE end_recurrence = '2011-03-14'
     * $query->filterByEndRecurrence(array('max' => 'yesterday')); // WHERE end_recurrence > '2011-03-13'
     * </code>
     *
     * @param     mixed $endRecurrence The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByEndRecurrence($endRecurrence = null, $comparison = null)
    {
        if (is_array($endRecurrence)) {
            $useMinMax = false;
            if (isset($endRecurrence['min'])) {
                $this->addUsingAlias(HourTableMap::COL_END_RECURRENCE, $endRecurrence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endRecurrence['max'])) {
                $this->addUsingAlias(HourTableMap::COL_END_RECURRENCE, $endRecurrence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_END_RECURRENCE, $endRecurrence, $comparison);
    }

    /**
     * Filter the query on the start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByStartTime('2011-03-14'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime('now'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime(array('max' => 'yesterday')); // WHERE start_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $startTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByStartTime($startTime = null, $comparison = null)
    {
        if (is_array($startTime)) {
            $useMinMax = false;
            if (isset($startTime['min'])) {
                $this->addUsingAlias(HourTableMap::COL_START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startTime['max'])) {
                $this->addUsingAlias(HourTableMap::COL_START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_START_TIME, $startTime, $comparison);
    }

    /**
     * Filter the query on the end_time column
     *
     * Example usage:
     * <code>
     * $query->filterByEndTime('2011-03-14'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime('now'); // WHERE end_time = '2011-03-14'
     * $query->filterByEndTime(array('max' => 'yesterday')); // WHERE end_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $endTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByEndTime($endTime = null, $comparison = null)
    {
        if (is_array($endTime)) {
            $useMinMax = false;
            if (isset($endTime['min'])) {
                $this->addUsingAlias(HourTableMap::COL_END_TIME, $endTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endTime['max'])) {
                $this->addUsingAlias(HourTableMap::COL_END_TIME, $endTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_END_TIME, $endTime, $comparison);
    }

    /**
     * Filter the query on the day_of_week column
     *
     * Example usage:
     * <code>
     * $query->filterByDayOfWeek('2011-03-14'); // WHERE day_of_week = '2011-03-14'
     * $query->filterByDayOfWeek('now'); // WHERE day_of_week = '2011-03-14'
     * $query->filterByDayOfWeek(array('max' => 'yesterday')); // WHERE day_of_week > '2011-03-13'
     * </code>
     *
     * @param     mixed $dayOfWeek The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function filterByDayOfWeek($dayOfWeek = null, $comparison = null)
    {
        if (is_array($dayOfWeek)) {
            $useMinMax = false;
            if (isset($dayOfWeek['min'])) {
                $this->addUsingAlias(HourTableMap::COL_DAY_OF_WEEK, $dayOfWeek['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayOfWeek['max'])) {
                $this->addUsingAlias(HourTableMap::COL_DAY_OF_WEEK, $dayOfWeek['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HourTableMap::COL_DAY_OF_WEEK, $dayOfWeek, $comparison);
    }

    /**
     * Filter the query by a related \Employee object
     *
     * @param \Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildHourQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \Employee) {
            return $this
                ->addUsingAlias(HourTableMap::COL_ADVISOR_ID, $employee->getUid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(HourTableMap::COL_ADVISOR_ID, $employee->toKeyValue('PrimaryKey', 'Uid'), $comparison);
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function joinEmployee($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\EmployeeQuery):\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildHour $hour Object to remove from the list of results
     *
     * @return $this|ChildHourQuery The current query, for fluid interface
     */
    public function prune($hour = null)
    {
        if ($hour) {
            $this->addUsingAlias(HourTableMap::COL_ID, $hour->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hour table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HourTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HourTableMap::clearInstancePool();
            HourTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HourTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HourTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HourTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HourTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HourQuery
