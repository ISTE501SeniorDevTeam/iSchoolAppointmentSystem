<?php

namespace Base;

use \Student as ChildStudent;
use \StudentQuery as ChildStudentQuery;
use \Exception;
use \PDO;
use Map\StudentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'student' table.
 *
 *
 *
 * @method     ChildStudentQuery orderByUid($order = Criteria::ASC) Order by the uid column
 * @method     ChildStudentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStudentQuery orderByMajorId($order = Criteria::ASC) Order by the major_id column
 * @method     ChildStudentQuery orderByAdvisorId($order = Criteria::ASC) Order by the advisor_id column
 * @method     ChildStudentQuery orderByRitid($order = Criteria::ASC) Order by the ritid column
 *
 * @method     ChildStudentQuery groupByUid() Group by the uid column
 * @method     ChildStudentQuery groupByName() Group by the name column
 * @method     ChildStudentQuery groupByMajorId() Group by the major_id column
 * @method     ChildStudentQuery groupByAdvisorId() Group by the advisor_id column
 * @method     ChildStudentQuery groupByRitid() Group by the ritid column
 *
 * @method     ChildStudentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStudentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStudentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStudentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStudentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStudentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStudentQuery leftJoinMajor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Major relation
 * @method     ChildStudentQuery rightJoinMajor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Major relation
 * @method     ChildStudentQuery innerJoinMajor($relationAlias = null) Adds a INNER JOIN clause to the query using the Major relation
 *
 * @method     ChildStudentQuery joinWithMajor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Major relation
 *
 * @method     ChildStudentQuery leftJoinWithMajor() Adds a LEFT JOIN clause and with to the query using the Major relation
 * @method     ChildStudentQuery rightJoinWithMajor() Adds a RIGHT JOIN clause and with to the query using the Major relation
 * @method     ChildStudentQuery innerJoinWithMajor() Adds a INNER JOIN clause and with to the query using the Major relation
 *
 * @method     ChildStudentQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildStudentQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildStudentQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildStudentQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildStudentQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildStudentQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildStudentQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildStudentQuery leftJoinVisit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Visit relation
 * @method     ChildStudentQuery rightJoinVisit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Visit relation
 * @method     ChildStudentQuery innerJoinVisit($relationAlias = null) Adds a INNER JOIN clause to the query using the Visit relation
 *
 * @method     ChildStudentQuery joinWithVisit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Visit relation
 *
 * @method     ChildStudentQuery leftJoinWithVisit() Adds a LEFT JOIN clause and with to the query using the Visit relation
 * @method     ChildStudentQuery rightJoinWithVisit() Adds a RIGHT JOIN clause and with to the query using the Visit relation
 * @method     ChildStudentQuery innerJoinWithVisit() Adds a INNER JOIN clause and with to the query using the Visit relation
 *
 * @method     \MajorQuery|\EmployeeQuery|\VisitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStudent|null findOne(ConnectionInterface $con = null) Return the first ChildStudent matching the query
 * @method     ChildStudent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStudent matching the query, or a new ChildStudent object populated from the query conditions when no match is found
 *
 * @method     ChildStudent|null findOneByUid(string $uid) Return the first ChildStudent filtered by the uid column
 * @method     ChildStudent|null findOneByName(string $name) Return the first ChildStudent filtered by the name column
 * @method     ChildStudent|null findOneByMajorId(int $major_id) Return the first ChildStudent filtered by the major_id column
 * @method     ChildStudent|null findOneByAdvisorId(string $advisor_id) Return the first ChildStudent filtered by the advisor_id column
 * @method     ChildStudent|null findOneByRitid(string $ritid) Return the first ChildStudent filtered by the ritid column *

 * @method     ChildStudent requirePk($key, ConnectionInterface $con = null) Return the ChildStudent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudent requireOne(ConnectionInterface $con = null) Return the first ChildStudent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStudent requireOneByUid(string $uid) Return the first ChildStudent filtered by the uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudent requireOneByName(string $name) Return the first ChildStudent filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudent requireOneByMajorId(int $major_id) Return the first ChildStudent filtered by the major_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudent requireOneByAdvisorId(string $advisor_id) Return the first ChildStudent filtered by the advisor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStudent requireOneByRitid(string $ritid) Return the first ChildStudent filtered by the ritid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStudent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStudent objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildStudent> find(ConnectionInterface $con = null) Return ChildStudent objects based on current ModelCriteria
 * @method     ChildStudent[]|ObjectCollection findByUid(string $uid) Return ChildStudent objects filtered by the uid column
 * @psalm-method ObjectCollection&\Traversable<ChildStudent> findByUid(string $uid) Return ChildStudent objects filtered by the uid column
 * @method     ChildStudent[]|ObjectCollection findByName(string $name) Return ChildStudent objects filtered by the name column
 * @psalm-method ObjectCollection&\Traversable<ChildStudent> findByName(string $name) Return ChildStudent objects filtered by the name column
 * @method     ChildStudent[]|ObjectCollection findByMajorId(int $major_id) Return ChildStudent objects filtered by the major_id column
 * @psalm-method ObjectCollection&\Traversable<ChildStudent> findByMajorId(int $major_id) Return ChildStudent objects filtered by the major_id column
 * @method     ChildStudent[]|ObjectCollection findByAdvisorId(string $advisor_id) Return ChildStudent objects filtered by the advisor_id column
 * @psalm-method ObjectCollection&\Traversable<ChildStudent> findByAdvisorId(string $advisor_id) Return ChildStudent objects filtered by the advisor_id column
 * @method     ChildStudent[]|ObjectCollection findByRitid(string $ritid) Return ChildStudent objects filtered by the ritid column
 * @psalm-method ObjectCollection&\Traversable<ChildStudent> findByRitid(string $ritid) Return ChildStudent objects filtered by the ritid column
 * @method     ChildStudent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStudent> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StudentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StudentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Student', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStudentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStudentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStudentQuery) {
            return $criteria;
        }
        $query = new ChildStudentQuery();
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
     * @return ChildStudent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StudentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StudentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStudent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uid, name, major_id, advisor_id, ritid FROM student WHERE uid = :p0';
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
            /** @var ChildStudent $obj */
            $obj = new ChildStudent();
            $obj->hydrate($row);
            StudentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStudent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StudentTableMap::COL_UID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StudentTableMap::COL_UID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the uid column
     *
     * Example usage:
     * <code>
     * $query->filterByUid('fooValue');   // WHERE uid = 'fooValue'
     * $query->filterByUid('%fooValue%', Criteria::LIKE); // WHERE uid LIKE '%fooValue%'
     * $query->filterByUid(['foo', 'bar']); // WHERE uid IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $uid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function filterByUid($uid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudentTableMap::COL_UID, $uid, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudentTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the major_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMajorId(1234); // WHERE major_id = 1234
     * $query->filterByMajorId(array(12, 34)); // WHERE major_id IN (12, 34)
     * $query->filterByMajorId(array('min' => 12)); // WHERE major_id > 12
     * </code>
     *
     * @see       filterByMajor()
     *
     * @param     mixed $majorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function filterByMajorId($majorId = null, $comparison = null)
    {
        if (is_array($majorId)) {
            $useMinMax = false;
            if (isset($majorId['min'])) {
                $this->addUsingAlias(StudentTableMap::COL_MAJOR_ID, $majorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($majorId['max'])) {
                $this->addUsingAlias(StudentTableMap::COL_MAJOR_ID, $majorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudentTableMap::COL_MAJOR_ID, $majorId, $comparison);
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
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function filterByAdvisorId($advisorId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($advisorId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudentTableMap::COL_ADVISOR_ID, $advisorId, $comparison);
    }

    /**
     * Filter the query on the ritid column
     *
     * Example usage:
     * <code>
     * $query->filterByRitid('fooValue');   // WHERE ritid = 'fooValue'
     * $query->filterByRitid('%fooValue%', Criteria::LIKE); // WHERE ritid LIKE '%fooValue%'
     * $query->filterByRitid(['foo', 'bar']); // WHERE ritid IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $ritid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function filterByRitid($ritid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ritid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StudentTableMap::COL_RITID, $ritid, $comparison);
    }

    /**
     * Filter the query by a related \Major object
     *
     * @param \Major|ObjectCollection $major The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStudentQuery The current query, for fluid interface
     */
    public function filterByMajor($major, $comparison = null)
    {
        if ($major instanceof \Major) {
            return $this
                ->addUsingAlias(StudentTableMap::COL_MAJOR_ID, $major->getId(), $comparison);
        } elseif ($major instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StudentTableMap::COL_MAJOR_ID, $major->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMajor() only accepts arguments of type \Major or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Major relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function joinMajor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Major');

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
            $this->addJoinObject($join, 'Major');
        }

        return $this;
    }

    /**
     * Use the Major relation Major object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MajorQuery A secondary query class using the current class as primary query
     */
    public function useMajorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMajor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Major', '\MajorQuery');
    }

    /**
     * Use the Major relation Major object
     *
     * @param callable(\MajorQuery):\MajorQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMajorQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMajorQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Major table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \MajorQuery The inner query object of the EXISTS statement
     */
    public function useMajorExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Major', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Major table for a NOT EXISTS query.
     *
     * @see useMajorExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \MajorQuery The inner query object of the NOT EXISTS statement
     */
    public function useMajorNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Major', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Employee object
     *
     * @param \Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStudentQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \Employee) {
            return $this
                ->addUsingAlias(StudentTableMap::COL_ADVISOR_ID, $employee->getUid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StudentTableMap::COL_ADVISOR_ID, $employee->toKeyValue('PrimaryKey', 'Uid'), $comparison);
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
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function joinEmployee($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Visit object
     *
     * @param \Visit|ObjectCollection $visit the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStudentQuery The current query, for fluid interface
     */
    public function filterByVisit($visit, $comparison = null)
    {
        if ($visit instanceof \Visit) {
            return $this
                ->addUsingAlias(StudentTableMap::COL_UID, $visit->getStudentId(), $comparison);
        } elseif ($visit instanceof ObjectCollection) {
            return $this
                ->useVisitQuery()
                ->filterByPrimaryKeys($visit->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVisit() only accepts arguments of type \Visit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Visit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function joinVisit($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Visit');

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
            $this->addJoinObject($join, 'Visit');
        }

        return $this;
    }

    /**
     * Use the Visit relation Visit object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VisitQuery A secondary query class using the current class as primary query
     */
    public function useVisitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVisit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Visit', '\VisitQuery');
    }

    /**
     * Use the Visit relation Visit object
     *
     * @param callable(\VisitQuery):\VisitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVisitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVisitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Visit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \VisitQuery The inner query object of the EXISTS statement
     */
    public function useVisitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Visit', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Visit table for a NOT EXISTS query.
     *
     * @see useVisitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \VisitQuery The inner query object of the NOT EXISTS statement
     */
    public function useVisitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Visit', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildStudent $student Object to remove from the list of results
     *
     * @return $this|ChildStudentQuery The current query, for fluid interface
     */
    public function prune($student = null)
    {
        if ($student) {
            $this->addUsingAlias(StudentTableMap::COL_UID, $student->getUid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the student table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StudentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StudentTableMap::clearInstancePool();
            StudentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StudentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StudentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StudentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StudentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StudentQuery
