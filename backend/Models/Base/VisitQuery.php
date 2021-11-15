<?php

namespace Base;

use \Visit as ChildVisit;
use \VisitQuery as ChildVisitQuery;
use \Exception;
use \PDO;
use Map\VisitTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'visit' table.
 *
 *
 *
 * @method     ChildVisitQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVisitQuery orderByAdvisorId($order = Criteria::ASC) Order by the advisor_id column
 * @method     ChildVisitQuery orderByStudentId($order = Criteria::ASC) Order by the student_id column
 * @method     ChildVisitQuery orderByReasonId($order = Criteria::ASC) Order by the reason_id column
 * @method     ChildVisitQuery orderByModalityId($order = Criteria::ASC) Order by the modality_id column
 * @method     ChildVisitQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildVisitQuery orderByInvitedAt($order = Criteria::ASC) Order by the invited_at column
 * @method     ChildVisitQuery orderByCompleteAt($order = Criteria::ASC) Order by the complete_at column
 * @method     ChildVisitQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildVisitQuery orderByCustomReason($order = Criteria::ASC) Order by the custom_reason column
 *
 * @method     ChildVisitQuery groupById() Group by the id column
 * @method     ChildVisitQuery groupByAdvisorId() Group by the advisor_id column
 * @method     ChildVisitQuery groupByStudentId() Group by the student_id column
 * @method     ChildVisitQuery groupByReasonId() Group by the reason_id column
 * @method     ChildVisitQuery groupByModalityId() Group by the modality_id column
 * @method     ChildVisitQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildVisitQuery groupByInvitedAt() Group by the invited_at column
 * @method     ChildVisitQuery groupByCompleteAt() Group by the complete_at column
 * @method     ChildVisitQuery groupByPosition() Group by the position column
 * @method     ChildVisitQuery groupByCustomReason() Group by the custom_reason column
 *
 * @method     ChildVisitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVisitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVisitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVisitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVisitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVisitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVisitQuery leftJoinStudent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Student relation
 * @method     ChildVisitQuery rightJoinStudent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Student relation
 * @method     ChildVisitQuery innerJoinStudent($relationAlias = null) Adds a INNER JOIN clause to the query using the Student relation
 *
 * @method     ChildVisitQuery joinWithStudent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Student relation
 *
 * @method     ChildVisitQuery leftJoinWithStudent() Adds a LEFT JOIN clause and with to the query using the Student relation
 * @method     ChildVisitQuery rightJoinWithStudent() Adds a RIGHT JOIN clause and with to the query using the Student relation
 * @method     ChildVisitQuery innerJoinWithStudent() Adds a INNER JOIN clause and with to the query using the Student relation
 *
 * @method     ChildVisitQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildVisitQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildVisitQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildVisitQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildVisitQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildVisitQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildVisitQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildVisitQuery leftJoinReason($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reason relation
 * @method     ChildVisitQuery rightJoinReason($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reason relation
 * @method     ChildVisitQuery innerJoinReason($relationAlias = null) Adds a INNER JOIN clause to the query using the Reason relation
 *
 * @method     ChildVisitQuery joinWithReason($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reason relation
 *
 * @method     ChildVisitQuery leftJoinWithReason() Adds a LEFT JOIN clause and with to the query using the Reason relation
 * @method     ChildVisitQuery rightJoinWithReason() Adds a RIGHT JOIN clause and with to the query using the Reason relation
 * @method     ChildVisitQuery innerJoinWithReason() Adds a INNER JOIN clause and with to the query using the Reason relation
 *
 * @method     ChildVisitQuery leftJoinModality($relationAlias = null) Adds a LEFT JOIN clause to the query using the Modality relation
 * @method     ChildVisitQuery rightJoinModality($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Modality relation
 * @method     ChildVisitQuery innerJoinModality($relationAlias = null) Adds a INNER JOIN clause to the query using the Modality relation
 *
 * @method     ChildVisitQuery joinWithModality($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Modality relation
 *
 * @method     ChildVisitQuery leftJoinWithModality() Adds a LEFT JOIN clause and with to the query using the Modality relation
 * @method     ChildVisitQuery rightJoinWithModality() Adds a RIGHT JOIN clause and with to the query using the Modality relation
 * @method     ChildVisitQuery innerJoinWithModality() Adds a INNER JOIN clause and with to the query using the Modality relation
 *
 * @method     \StudentQuery|\EmployeeQuery|\ReasonQuery|\ModalityQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVisit|null findOne(ConnectionInterface $con = null) Return the first ChildVisit matching the query
 * @method     ChildVisit findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVisit matching the query, or a new ChildVisit object populated from the query conditions when no match is found
 *
 * @method     ChildVisit|null findOneById(string $id) Return the first ChildVisit filtered by the id column
 * @method     ChildVisit|null findOneByAdvisorId(string $advisor_id) Return the first ChildVisit filtered by the advisor_id column
 * @method     ChildVisit|null findOneByStudentId(string $student_id) Return the first ChildVisit filtered by the student_id column
 * @method     ChildVisit|null findOneByReasonId(int $reason_id) Return the first ChildVisit filtered by the reason_id column
 * @method     ChildVisit|null findOneByModalityId(int $modality_id) Return the first ChildVisit filtered by the modality_id column
 * @method     ChildVisit|null findOneByCreatedAt(string $created_at) Return the first ChildVisit filtered by the created_at column
 * @method     ChildVisit|null findOneByInvitedAt(string $invited_at) Return the first ChildVisit filtered by the invited_at column
 * @method     ChildVisit|null findOneByCompleteAt(string $complete_at) Return the first ChildVisit filtered by the complete_at column
 * @method     ChildVisit|null findOneByPosition(int $position) Return the first ChildVisit filtered by the position column
 * @method     ChildVisit|null findOneByCustomReason(string $custom_reason) Return the first ChildVisit filtered by the custom_reason column *

 * @method     ChildVisit requirePk($key, ConnectionInterface $con = null) Return the ChildVisit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOne(ConnectionInterface $con = null) Return the first ChildVisit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVisit requireOneById(string $id) Return the first ChildVisit filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByAdvisorId(string $advisor_id) Return the first ChildVisit filtered by the advisor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByStudentId(string $student_id) Return the first ChildVisit filtered by the student_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByReasonId(int $reason_id) Return the first ChildVisit filtered by the reason_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByModalityId(int $modality_id) Return the first ChildVisit filtered by the modality_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByCreatedAt(string $created_at) Return the first ChildVisit filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByInvitedAt(string $invited_at) Return the first ChildVisit filtered by the invited_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByCompleteAt(string $complete_at) Return the first ChildVisit filtered by the complete_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByPosition(int $position) Return the first ChildVisit filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVisit requireOneByCustomReason(string $custom_reason) Return the first ChildVisit filtered by the custom_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVisit[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVisit objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> find(ConnectionInterface $con = null) Return ChildVisit objects based on current ModelCriteria
 * @method     ChildVisit[]|ObjectCollection findById(string $id) Return ChildVisit objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findById(string $id) Return ChildVisit objects filtered by the id column
 * @method     ChildVisit[]|ObjectCollection findByAdvisorId(string $advisor_id) Return ChildVisit objects filtered by the advisor_id column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByAdvisorId(string $advisor_id) Return ChildVisit objects filtered by the advisor_id column
 * @method     ChildVisit[]|ObjectCollection findByStudentId(string $student_id) Return ChildVisit objects filtered by the student_id column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByStudentId(string $student_id) Return ChildVisit objects filtered by the student_id column
 * @method     ChildVisit[]|ObjectCollection findByReasonId(int $reason_id) Return ChildVisit objects filtered by the reason_id column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByReasonId(int $reason_id) Return ChildVisit objects filtered by the reason_id column
 * @method     ChildVisit[]|ObjectCollection findByModalityId(int $modality_id) Return ChildVisit objects filtered by the modality_id column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByModalityId(int $modality_id) Return ChildVisit objects filtered by the modality_id column
 * @method     ChildVisit[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildVisit objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByCreatedAt(string $created_at) Return ChildVisit objects filtered by the created_at column
 * @method     ChildVisit[]|ObjectCollection findByInvitedAt(string $invited_at) Return ChildVisit objects filtered by the invited_at column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByInvitedAt(string $invited_at) Return ChildVisit objects filtered by the invited_at column
 * @method     ChildVisit[]|ObjectCollection findByCompleteAt(string $complete_at) Return ChildVisit objects filtered by the complete_at column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByCompleteAt(string $complete_at) Return ChildVisit objects filtered by the complete_at column
 * @method     ChildVisit[]|ObjectCollection findByPosition(int $position) Return ChildVisit objects filtered by the position column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByPosition(int $position) Return ChildVisit objects filtered by the position column
 * @method     ChildVisit[]|ObjectCollection findByCustomReason(string $custom_reason) Return ChildVisit objects filtered by the custom_reason column
 * @psalm-method ObjectCollection&\Traversable<ChildVisit> findByCustomReason(string $custom_reason) Return ChildVisit objects filtered by the custom_reason column
 * @method     ChildVisit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVisit> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VisitQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VisitQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Visit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVisitQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVisitQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVisitQuery) {
            return $criteria;
        }
        $query = new ChildVisitQuery();
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
     * @return ChildVisit|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VisitTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VisitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVisit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, advisor_id, student_id, reason_id, modality_id, created_at, invited_at, complete_at, position, custom_reason FROM visit WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVisit $obj */
            $obj = new ChildVisit();
            $obj->hydrate($row);
            VisitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVisit|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VisitTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VisitTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * $query->filterById(['foo', 'bar']); // WHERE id IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByAdvisorId($advisorId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($advisorId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_ADVISOR_ID, $advisorId, $comparison);
    }

    /**
     * Filter the query on the student_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStudentId('fooValue');   // WHERE student_id = 'fooValue'
     * $query->filterByStudentId('%fooValue%', Criteria::LIKE); // WHERE student_id LIKE '%fooValue%'
     * $query->filterByStudentId(['foo', 'bar']); // WHERE student_id IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $studentId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByStudentId($studentId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($studentId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_STUDENT_ID, $studentId, $comparison);
    }

    /**
     * Filter the query on the reason_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReasonId(1234); // WHERE reason_id = 1234
     * $query->filterByReasonId(array(12, 34)); // WHERE reason_id IN (12, 34)
     * $query->filterByReasonId(array('min' => 12)); // WHERE reason_id > 12
     * </code>
     *
     * @see       filterByReason()
     *
     * @param     mixed $reasonId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByReasonId($reasonId = null, $comparison = null)
    {
        if (is_array($reasonId)) {
            $useMinMax = false;
            if (isset($reasonId['min'])) {
                $this->addUsingAlias(VisitTableMap::COL_REASON_ID, $reasonId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reasonId['max'])) {
                $this->addUsingAlias(VisitTableMap::COL_REASON_ID, $reasonId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_REASON_ID, $reasonId, $comparison);
    }

    /**
     * Filter the query on the modality_id column
     *
     * Example usage:
     * <code>
     * $query->filterByModalityId(1234); // WHERE modality_id = 1234
     * $query->filterByModalityId(array(12, 34)); // WHERE modality_id IN (12, 34)
     * $query->filterByModalityId(array('min' => 12)); // WHERE modality_id > 12
     * </code>
     *
     * @see       filterByModality()
     *
     * @param     mixed $modalityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByModalityId($modalityId = null, $comparison = null)
    {
        if (is_array($modalityId)) {
            $useMinMax = false;
            if (isset($modalityId['min'])) {
                $this->addUsingAlias(VisitTableMap::COL_MODALITY_ID, $modalityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modalityId['max'])) {
                $this->addUsingAlias(VisitTableMap::COL_MODALITY_ID, $modalityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_MODALITY_ID, $modalityId, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(VisitTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(VisitTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the invited_at column
     *
     * Example usage:
     * <code>
     * $query->filterByInvitedAt('2011-03-14'); // WHERE invited_at = '2011-03-14'
     * $query->filterByInvitedAt('now'); // WHERE invited_at = '2011-03-14'
     * $query->filterByInvitedAt(array('max' => 'yesterday')); // WHERE invited_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $invitedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByInvitedAt($invitedAt = null, $comparison = null)
    {
        if (is_array($invitedAt)) {
            $useMinMax = false;
            if (isset($invitedAt['min'])) {
                $this->addUsingAlias(VisitTableMap::COL_INVITED_AT, $invitedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invitedAt['max'])) {
                $this->addUsingAlias(VisitTableMap::COL_INVITED_AT, $invitedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_INVITED_AT, $invitedAt, $comparison);
    }

    /**
     * Filter the query on the complete_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCompleteAt('2011-03-14'); // WHERE complete_at = '2011-03-14'
     * $query->filterByCompleteAt('now'); // WHERE complete_at = '2011-03-14'
     * $query->filterByCompleteAt(array('max' => 'yesterday')); // WHERE complete_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $completeAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByCompleteAt($completeAt = null, $comparison = null)
    {
        if (is_array($completeAt)) {
            $useMinMax = false;
            if (isset($completeAt['min'])) {
                $this->addUsingAlias(VisitTableMap::COL_COMPLETE_AT, $completeAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completeAt['max'])) {
                $this->addUsingAlias(VisitTableMap::COL_COMPLETE_AT, $completeAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_COMPLETE_AT, $completeAt, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(VisitTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(VisitTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_POSITION, $position, $comparison);
    }

    /**
     * Filter the query on the custom_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomReason('fooValue');   // WHERE custom_reason = 'fooValue'
     * $query->filterByCustomReason('%fooValue%', Criteria::LIKE); // WHERE custom_reason LIKE '%fooValue%'
     * $query->filterByCustomReason(['foo', 'bar']); // WHERE custom_reason IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $customReason The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function filterByCustomReason($customReason = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customReason)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VisitTableMap::COL_CUSTOM_REASON, $customReason, $comparison);
    }

    /**
     * Filter the query by a related \Student object
     *
     * @param \Student|ObjectCollection $student The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVisitQuery The current query, for fluid interface
     */
    public function filterByStudent($student, $comparison = null)
    {
        if ($student instanceof \Student) {
            return $this
                ->addUsingAlias(VisitTableMap::COL_STUDENT_ID, $student->getUid(), $comparison);
        } elseif ($student instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VisitTableMap::COL_STUDENT_ID, $student->toKeyValue('PrimaryKey', 'Uid'), $comparison);
        } else {
            throw new PropelException('filterByStudent() only accepts arguments of type \Student or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Student relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function joinStudent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Student');

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
            $this->addJoinObject($join, 'Student');
        }

        return $this;
    }

    /**
     * Use the Student relation Student object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StudentQuery A secondary query class using the current class as primary query
     */
    public function useStudentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStudent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Student', '\StudentQuery');
    }

    /**
     * Use the Student relation Student object
     *
     * @param callable(\StudentQuery):\StudentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStudentQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStudentQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Student table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \StudentQuery The inner query object of the EXISTS statement
     */
    public function useStudentExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Student', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Student table for a NOT EXISTS query.
     *
     * @see useStudentExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \StudentQuery The inner query object of the NOT EXISTS statement
     */
    public function useStudentNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Student', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Employee object
     *
     * @param \Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVisitQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \Employee) {
            return $this
                ->addUsingAlias(VisitTableMap::COL_ADVISOR_ID, $employee->getUid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VisitTableMap::COL_ADVISOR_ID, $employee->toKeyValue('PrimaryKey', 'Uid'), $comparison);
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
     * @return $this|ChildVisitQuery The current query, for fluid interface
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
     * Filter the query by a related \Reason object
     *
     * @param \Reason|ObjectCollection $reason The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVisitQuery The current query, for fluid interface
     */
    public function filterByReason($reason, $comparison = null)
    {
        if ($reason instanceof \Reason) {
            return $this
                ->addUsingAlias(VisitTableMap::COL_REASON_ID, $reason->getId(), $comparison);
        } elseif ($reason instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VisitTableMap::COL_REASON_ID, $reason->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByReason() only accepts arguments of type \Reason or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reason relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function joinReason($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reason');

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
            $this->addJoinObject($join, 'Reason');
        }

        return $this;
    }

    /**
     * Use the Reason relation Reason object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ReasonQuery A secondary query class using the current class as primary query
     */
    public function useReasonQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReason($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reason', '\ReasonQuery');
    }

    /**
     * Use the Reason relation Reason object
     *
     * @param callable(\ReasonQuery):\ReasonQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReasonQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReasonQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Reason table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ReasonQuery The inner query object of the EXISTS statement
     */
    public function useReasonExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Reason', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Reason table for a NOT EXISTS query.
     *
     * @see useReasonExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ReasonQuery The inner query object of the NOT EXISTS statement
     */
    public function useReasonNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Reason', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Modality object
     *
     * @param \Modality|ObjectCollection $modality The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVisitQuery The current query, for fluid interface
     */
    public function filterByModality($modality, $comparison = null)
    {
        if ($modality instanceof \Modality) {
            return $this
                ->addUsingAlias(VisitTableMap::COL_MODALITY_ID, $modality->getId(), $comparison);
        } elseif ($modality instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VisitTableMap::COL_MODALITY_ID, $modality->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByModality() only accepts arguments of type \Modality or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Modality relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function joinModality($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Modality');

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
            $this->addJoinObject($join, 'Modality');
        }

        return $this;
    }

    /**
     * Use the Modality relation Modality object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ModalityQuery A secondary query class using the current class as primary query
     */
    public function useModalityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinModality($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Modality', '\ModalityQuery');
    }

    /**
     * Use the Modality relation Modality object
     *
     * @param callable(\ModalityQuery):\ModalityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withModalityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useModalityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Modality table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ModalityQuery The inner query object of the EXISTS statement
     */
    public function useModalityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Modality', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Modality table for a NOT EXISTS query.
     *
     * @see useModalityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ModalityQuery The inner query object of the NOT EXISTS statement
     */
    public function useModalityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Modality', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildVisit $visit Object to remove from the list of results
     *
     * @return $this|ChildVisitQuery The current query, for fluid interface
     */
    public function prune($visit = null)
    {
        if ($visit) {
            $this->addUsingAlias(VisitTableMap::COL_ID, $visit->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the visit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VisitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VisitTableMap::clearInstancePool();
            VisitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VisitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VisitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VisitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VisitTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VisitQuery
