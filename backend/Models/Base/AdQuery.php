<?php

namespace Base;

use \Ad as ChildAd;
use \AdQuery as ChildAdQuery;
use \Exception;
use \PDO;
use Map\AdTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ad' table.
 *
 *
 *
 * @method     ChildAdQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAdQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildAdQuery orderByStartsAt($order = Criteria::ASC) Order by the starts_at column
 * @method     ChildAdQuery orderByEndsAt($order = Criteria::ASC) Order by the ends_at column
 *
 * @method     ChildAdQuery groupById() Group by the id column
 * @method     ChildAdQuery groupByUrl() Group by the url column
 * @method     ChildAdQuery groupByStartsAt() Group by the starts_at column
 * @method     ChildAdQuery groupByEndsAt() Group by the ends_at column
 *
 * @method     ChildAdQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAdQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAdQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAdQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAdQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAdQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAd|null findOne(ConnectionInterface $con = null) Return the first ChildAd matching the query
 * @method     ChildAd findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAd matching the query, or a new ChildAd object populated from the query conditions when no match is found
 *
 * @method     ChildAd|null findOneById(string $id) Return the first ChildAd filtered by the id column
 * @method     ChildAd|null findOneByUrl(string $url) Return the first ChildAd filtered by the url column
 * @method     ChildAd|null findOneByStartsAt(string $starts_at) Return the first ChildAd filtered by the starts_at column
 * @method     ChildAd|null findOneByEndsAt(string $ends_at) Return the first ChildAd filtered by the ends_at column *

 * @method     ChildAd requirePk($key, ConnectionInterface $con = null) Return the ChildAd by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAd requireOne(ConnectionInterface $con = null) Return the first ChildAd matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAd requireOneById(string $id) Return the first ChildAd filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAd requireOneByUrl(string $url) Return the first ChildAd filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAd requireOneByStartsAt(string $starts_at) Return the first ChildAd filtered by the starts_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAd requireOneByEndsAt(string $ends_at) Return the first ChildAd filtered by the ends_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAd[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAd objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildAd> find(ConnectionInterface $con = null) Return ChildAd objects based on current ModelCriteria
 * @method     ChildAd[]|ObjectCollection findById(string $id) Return ChildAd objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildAd> findById(string $id) Return ChildAd objects filtered by the id column
 * @method     ChildAd[]|ObjectCollection findByUrl(string $url) Return ChildAd objects filtered by the url column
 * @psalm-method ObjectCollection&\Traversable<ChildAd> findByUrl(string $url) Return ChildAd objects filtered by the url column
 * @method     ChildAd[]|ObjectCollection findByStartsAt(string $starts_at) Return ChildAd objects filtered by the starts_at column
 * @psalm-method ObjectCollection&\Traversable<ChildAd> findByStartsAt(string $starts_at) Return ChildAd objects filtered by the starts_at column
 * @method     ChildAd[]|ObjectCollection findByEndsAt(string $ends_at) Return ChildAd objects filtered by the ends_at column
 * @psalm-method ObjectCollection&\Traversable<ChildAd> findByEndsAt(string $ends_at) Return ChildAd objects filtered by the ends_at column
 * @method     ChildAd[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAd> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AdQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AdQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Ad', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAdQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAdQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAdQuery) {
            return $criteria;
        }
        $query = new ChildAdQuery();
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
     * @return ChildAd|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AdTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAd A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, url, starts_at, ends_at FROM ad WHERE id = :p0';
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
            /** @var ChildAd $obj */
            $obj = new ChildAd();
            $obj->hydrate($row);
            AdTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAd|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAdQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AdTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAdQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AdTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAdQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * $query->filterByUrl(['foo', 'bar']); // WHERE url IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAdQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdTableMap::COL_URL, $url, $comparison);
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
     * @return $this|ChildAdQuery The current query, for fluid interface
     */
    public function filterByStartsAt($startsAt = null, $comparison = null)
    {
        if (is_array($startsAt)) {
            $useMinMax = false;
            if (isset($startsAt['min'])) {
                $this->addUsingAlias(AdTableMap::COL_STARTS_AT, $startsAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startsAt['max'])) {
                $this->addUsingAlias(AdTableMap::COL_STARTS_AT, $startsAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdTableMap::COL_STARTS_AT, $startsAt, $comparison);
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
     * @return $this|ChildAdQuery The current query, for fluid interface
     */
    public function filterByEndsAt($endsAt = null, $comparison = null)
    {
        if (is_array($endsAt)) {
            $useMinMax = false;
            if (isset($endsAt['min'])) {
                $this->addUsingAlias(AdTableMap::COL_ENDS_AT, $endsAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endsAt['max'])) {
                $this->addUsingAlias(AdTableMap::COL_ENDS_AT, $endsAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdTableMap::COL_ENDS_AT, $endsAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAd $ad Object to remove from the list of results
     *
     * @return $this|ChildAdQuery The current query, for fluid interface
     */
    public function prune($ad = null)
    {
        if ($ad) {
            $this->addUsingAlias(AdTableMap::COL_ID, $ad->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ad table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AdTableMap::clearInstancePool();
            AdTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AdTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AdTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AdTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AdTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AdQuery
