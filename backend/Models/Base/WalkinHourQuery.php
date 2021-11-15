<?php

namespace Base;

use \WalkinHour as ChildWalkinHour;
use \WalkinHourQuery as ChildWalkinHourQuery;
use \Exception;
use \PDO;
use Map\WalkinHourTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'walkin_hour' table.
 *
 *
 *
 * @method     ChildWalkinHourQuery orderByAdvisorId($order = Criteria::ASC) Order by the advisor_id column
 * @method     ChildWalkinHourQuery orderByStartsAt($order = Criteria::ASC) Order by the starts_at column
 * @method     ChildWalkinHourQuery orderByEndsAt($order = Criteria::ASC) Order by the ends_at column
 *
 * @method     ChildWalkinHourQuery groupByAdvisorId() Group by the advisor_id column
 * @method     ChildWalkinHourQuery groupByStartsAt() Group by the starts_at column
 * @method     ChildWalkinHourQuery groupByEndsAt() Group by the ends_at column
 *
 * @method     ChildWalkinHourQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWalkinHourQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWalkinHourQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWalkinHourQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWalkinHourQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWalkinHourQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWalkinHourQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildWalkinHourQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildWalkinHourQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildWalkinHourQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildWalkinHourQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildWalkinHourQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildWalkinHourQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     \EmployeeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWalkinHour|null findOne(ConnectionInterface $con = null) Return the first ChildWalkinHour matching the query
 * @method     ChildWalkinHour findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWalkinHour matching the query, or a new ChildWalkinHour object populated from the query conditions when no match is found
 *
 * @method     ChildWalkinHour|null findOneByAdvisorId(string $advisor_id) Return the first ChildWalkinHour filtered by the advisor_id column
 * @method     ChildWalkinHour|null findOneByStartsAt(string $starts_at) Return the first ChildWalkinHour filtered by the starts_at column
 * @method     ChildWalkinHour|null findOneByEndsAt(string $ends_at) Return the first ChildWalkinHour filtered by the ends_at column *

 * @method     ChildWalkinHour requirePk($key, ConnectionInterface $con = null) Return the ChildWalkinHour by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalkinHour requireOne(ConnectionInterface $con = null) Return the first ChildWalkinHour matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWalkinHour requireOneByAdvisorId(string $advisor_id) Return the first ChildWalkinHour filtered by the advisor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalkinHour requireOneByStartsAt(string $starts_at) Return the first ChildWalkinHour filtered by the starts_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWalkinHour requireOneByEndsAt(string $ends_at) Return the first ChildWalkinHour filtered by the ends_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWalkinHour[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWalkinHour objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildWalkinHour> find(ConnectionInterface $con = null) Return ChildWalkinHour objects based on current ModelCriteria
 * @method     ChildWalkinHour[]|ObjectCollection findByAdvisorId(string $advisor_id) Return ChildWalkinHour objects filtered by the advisor_id column
 * @psalm-method ObjectCollection&\Traversable<ChildWalkinHour> findByAdvisorId(string $advisor_id) Return ChildWalkinHour objects filtered by the advisor_id column
 * @method     ChildWalkinHour[]|ObjectCollection findByStartsAt(string $starts_at) Return ChildWalkinHour objects filtered by the starts_at column
 * @psalm-method ObjectCollection&\Traversable<ChildWalkinHour> findByStartsAt(string $starts_at) Return ChildWalkinHour objects filtered by the starts_at column
 * @method     ChildWalkinHour[]|ObjectCollection findByEndsAt(string $ends_at) Return ChildWalkinHour objects filtered by the ends_at column
 * @psalm-method ObjectCollection&\Traversable<ChildWalkinHour> findByEndsAt(string $ends_at) Return ChildWalkinHour objects filtered by the ends_at column
 * @method     ChildWalkinHour[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWalkinHour> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WalkinHourQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WalkinHourQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\WalkinHour', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWalkinHourQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWalkinHourQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWalkinHourQuery) {
            return $criteria;
        }
        $query = new ChildWalkinHourQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$advisor_id, $starts_at, $ends_at] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWalkinHour|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WalkinHourTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WalkinHourTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
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
     * @return ChildWalkinHour A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT advisor_id, starts_at, ends_at FROM walkin_hour WHERE advisor_id = :p0 AND starts_at = :p1 AND ends_at = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1] ? $key[1]->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2] ? $key[2]->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWalkinHour $obj */
            $obj = new ChildWalkinHour();
            $obj->hydrate($row);
            WalkinHourTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildWalkinHour|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildWalkinHourQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(WalkinHourTableMap::COL_ADVISOR_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WalkinHourTableMap::COL_STARTS_AT, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(WalkinHourTableMap::COL_ENDS_AT, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWalkinHourQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(WalkinHourTableMap::COL_ADVISOR_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WalkinHourTableMap::COL_STARTS_AT, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(WalkinHourTableMap::COL_ENDS_AT, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildWalkinHourQuery The current query, for fluid interface
     */
    public function filterByAdvisorId($advisorId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($advisorId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalkinHourTableMap::COL_ADVISOR_ID, $advisorId, $comparison);
    }

    /**
     * Filter the query on the starts_at column
     *
     * Example usage:
     * <code>
     * $query->filterByStartsAt('2011-03-14'); // WHERE starts_at = '2011-03-14'
     * $query->filterByStartsAt('now'); // WHERE starts_at = '2011-03-14'
     * $query->filterByStartsAt(array('max' => 'yesterday')); // WHERE starts_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $startsAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalkinHourQuery The current query, for fluid interface
     */
    public function filterByStartsAt($startsAt = null, $comparison = null)
    {
        if (is_array($startsAt)) {
            $useMinMax = false;
            if (isset($startsAt['min'])) {
                $this->addUsingAlias(WalkinHourTableMap::COL_STARTS_AT, $startsAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startsAt['max'])) {
                $this->addUsingAlias(WalkinHourTableMap::COL_STARTS_AT, $startsAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalkinHourTableMap::COL_STARTS_AT, $startsAt, $comparison);
    }

    /**
     * Filter the query on the ends_at column
     *
     * Example usage:
     * <code>
     * $query->filterByEndsAt('2011-03-14'); // WHERE ends_at = '2011-03-14'
     * $query->filterByEndsAt('now'); // WHERE ends_at = '2011-03-14'
     * $query->filterByEndsAt(array('max' => 'yesterday')); // WHERE ends_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $endsAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWalkinHourQuery The current query, for fluid interface
     */
    public function filterByEndsAt($endsAt = null, $comparison = null)
    {
        if (is_array($endsAt)) {
            $useMinMax = false;
            if (isset($endsAt['min'])) {
                $this->addUsingAlias(WalkinHourTableMap::COL_ENDS_AT, $endsAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endsAt['max'])) {
                $this->addUsingAlias(WalkinHourTableMap::COL_ENDS_AT, $endsAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WalkinHourTableMap::COL_ENDS_AT, $endsAt, $comparison);
    }

    /**
     * Filter the query by a related \Employee object
     *
     * @param \Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWalkinHourQuery The current query, for fluid interface
     */
    public function filterByEmployee($employee, $comparison = null)
    {
        if ($employee instanceof \Employee) {
            return $this
                ->addUsingAlias(WalkinHourTableMap::COL_ADVISOR_ID, $employee->getUid(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(WalkinHourTableMap::COL_ADVISOR_ID, $employee->toKeyValue('PrimaryKey', 'Uid'), $comparison);
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
     * @return $this|ChildWalkinHourQuery The current query, for fluid interface
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
     * @param   ChildWalkinHour $walkinHour Object to remove from the list of results
     *
     * @return $this|ChildWalkinHourQuery The current query, for fluid interface
     */
    public function prune($walkinHour = null)
    {
        if ($walkinHour) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WalkinHourTableMap::COL_ADVISOR_ID), $walkinHour->getAdvisorId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WalkinHourTableMap::COL_STARTS_AT), $walkinHour->getStartsAt(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(WalkinHourTableMap::COL_ENDS_AT), $walkinHour->getEndsAt(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the walkin_hour table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WalkinHourTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WalkinHourTableMap::clearInstancePool();
            WalkinHourTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WalkinHourTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WalkinHourTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WalkinHourTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WalkinHourTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WalkinHourQuery
