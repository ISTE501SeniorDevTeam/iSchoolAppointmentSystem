<?php

namespace Base;

use \Employee as ChildEmployee;
use \EmployeeQuery as ChildEmployeeQuery;
use \Exception;
use \PDO;
use Map\EmployeeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'employee' table.
 *
 *
 *
 * @method     ChildEmployeeQuery orderByUid($order = Criteria::ASC) Order by the uid column
 * @method     ChildEmployeeQuery orderByHash($order = Criteria::ASC) Order by the hash column
 * @method     ChildEmployeeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildEmployeeQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildEmployeeQuery orderByPictureUrl($order = Criteria::ASC) Order by the picture_url column
 * @method     ChildEmployeeQuery orderByIsGradAdvisor($order = Criteria::ASC) Order by the is_grad_advisor column
 * @method     ChildEmployeeQuery orderByFirstLetter($order = Criteria::ASC) Order by the first_letter column
 * @method     ChildEmployeeQuery orderByLastLetter($order = Criteria::ASC) Order by the last_letter column
 *
 * @method     ChildEmployeeQuery groupByUid() Group by the uid column
 * @method     ChildEmployeeQuery groupByHash() Group by the hash column
 * @method     ChildEmployeeQuery groupByName() Group by the name column
 * @method     ChildEmployeeQuery groupByRoleId() Group by the role_id column
 * @method     ChildEmployeeQuery groupByPictureUrl() Group by the picture_url column
 * @method     ChildEmployeeQuery groupByIsGradAdvisor() Group by the is_grad_advisor column
 * @method     ChildEmployeeQuery groupByFirstLetter() Group by the first_letter column
 * @method     ChildEmployeeQuery groupByLastLetter() Group by the last_letter column
 *
 * @method     ChildEmployeeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeQuery leftJoinRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the Role relation
 * @method     ChildEmployeeQuery rightJoinRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Role relation
 * @method     ChildEmployeeQuery innerJoinRole($relationAlias = null) Adds a INNER JOIN clause to the query using the Role relation
 *
 * @method     ChildEmployeeQuery joinWithRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Role relation
 *
 * @method     ChildEmployeeQuery leftJoinWithRole() Adds a LEFT JOIN clause and with to the query using the Role relation
 * @method     ChildEmployeeQuery rightJoinWithRole() Adds a RIGHT JOIN clause and with to the query using the Role relation
 * @method     ChildEmployeeQuery innerJoinWithRole() Adds a INNER JOIN clause and with to the query using the Role relation
 *
 * @method     ChildEmployeeQuery leftJoinVisit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Visit relation
 * @method     ChildEmployeeQuery rightJoinVisit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Visit relation
 * @method     ChildEmployeeQuery innerJoinVisit($relationAlias = null) Adds a INNER JOIN clause to the query using the Visit relation
 *
 * @method     ChildEmployeeQuery joinWithVisit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Visit relation
 *
 * @method     ChildEmployeeQuery leftJoinWithVisit() Adds a LEFT JOIN clause and with to the query using the Visit relation
 * @method     ChildEmployeeQuery rightJoinWithVisit() Adds a RIGHT JOIN clause and with to the query using the Visit relation
 * @method     ChildEmployeeQuery innerJoinWithVisit() Adds a INNER JOIN clause and with to the query using the Visit relation
 *
 * @method     ChildEmployeeQuery leftJoinStudent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Student relation
 * @method     ChildEmployeeQuery rightJoinStudent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Student relation
 * @method     ChildEmployeeQuery innerJoinStudent($relationAlias = null) Adds a INNER JOIN clause to the query using the Student relation
 *
 * @method     ChildEmployeeQuery joinWithStudent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Student relation
 *
 * @method     ChildEmployeeQuery leftJoinWithStudent() Adds a LEFT JOIN clause and with to the query using the Student relation
 * @method     ChildEmployeeQuery rightJoinWithStudent() Adds a RIGHT JOIN clause and with to the query using the Student relation
 * @method     ChildEmployeeQuery innerJoinWithStudent() Adds a INNER JOIN clause and with to the query using the Student relation
 *
 * @method     ChildEmployeeQuery leftJoinToken($relationAlias = null) Adds a LEFT JOIN clause to the query using the Token relation
 * @method     ChildEmployeeQuery rightJoinToken($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Token relation
 * @method     ChildEmployeeQuery innerJoinToken($relationAlias = null) Adds a INNER JOIN clause to the query using the Token relation
 *
 * @method     ChildEmployeeQuery joinWithToken($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Token relation
 *
 * @method     ChildEmployeeQuery leftJoinWithToken() Adds a LEFT JOIN clause and with to the query using the Token relation
 * @method     ChildEmployeeQuery rightJoinWithToken() Adds a RIGHT JOIN clause and with to the query using the Token relation
 * @method     ChildEmployeeQuery innerJoinWithToken() Adds a INNER JOIN clause and with to the query using the Token relation
 *
 * @method     ChildEmployeeQuery leftJoinWalkinHour($relationAlias = null) Adds a LEFT JOIN clause to the query using the WalkinHour relation
 * @method     ChildEmployeeQuery rightJoinWalkinHour($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WalkinHour relation
 * @method     ChildEmployeeQuery innerJoinWalkinHour($relationAlias = null) Adds a INNER JOIN clause to the query using the WalkinHour relation
 *
 * @method     ChildEmployeeQuery joinWithWalkinHour($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WalkinHour relation
 *
 * @method     ChildEmployeeQuery leftJoinWithWalkinHour() Adds a LEFT JOIN clause and with to the query using the WalkinHour relation
 * @method     ChildEmployeeQuery rightJoinWithWalkinHour() Adds a RIGHT JOIN clause and with to the query using the WalkinHour relation
 * @method     ChildEmployeeQuery innerJoinWithWalkinHour() Adds a INNER JOIN clause and with to the query using the WalkinHour relation
 *
 * @method     ChildEmployeeQuery leftJoinHour($relationAlias = null) Adds a LEFT JOIN clause to the query using the Hour relation
 * @method     ChildEmployeeQuery rightJoinHour($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Hour relation
 * @method     ChildEmployeeQuery innerJoinHour($relationAlias = null) Adds a INNER JOIN clause to the query using the Hour relation
 *
 * @method     ChildEmployeeQuery joinWithHour($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Hour relation
 *
 * @method     ChildEmployeeQuery leftJoinWithHour() Adds a LEFT JOIN clause and with to the query using the Hour relation
 * @method     ChildEmployeeQuery rightJoinWithHour() Adds a RIGHT JOIN clause and with to the query using the Hour relation
 * @method     ChildEmployeeQuery innerJoinWithHour() Adds a INNER JOIN clause and with to the query using the Hour relation
 *
 * @method     \RoleQuery|\VisitQuery|\StudentQuery|\TokenQuery|\WalkinHourQuery|\HourQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployee|null findOne(ConnectionInterface $con = null) Return the first ChildEmployee matching the query
 * @method     ChildEmployee findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmployee matching the query, or a new ChildEmployee object populated from the query conditions when no match is found
 *
 * @method     ChildEmployee|null findOneByUid(string $uid) Return the first ChildEmployee filtered by the uid column
 * @method     ChildEmployee|null findOneByHash(string $hash) Return the first ChildEmployee filtered by the hash column
 * @method     ChildEmployee|null findOneByName(string $name) Return the first ChildEmployee filtered by the name column
 * @method     ChildEmployee|null findOneByRoleId(int $role_id) Return the first ChildEmployee filtered by the role_id column
 * @method     ChildEmployee|null findOneByPictureUrl(string $picture_url) Return the first ChildEmployee filtered by the picture_url column
 * @method     ChildEmployee|null findOneByIsGradAdvisor(boolean $is_grad_advisor) Return the first ChildEmployee filtered by the is_grad_advisor column
 * @method     ChildEmployee|null findOneByFirstLetter(string $first_letter) Return the first ChildEmployee filtered by the first_letter column
 * @method     ChildEmployee|null findOneByLastLetter(string $last_letter) Return the first ChildEmployee filtered by the last_letter column *

 * @method     ChildEmployee requirePk($key, ConnectionInterface $con = null) Return the ChildEmployee by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOne(ConnectionInterface $con = null) Return the first ChildEmployee matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee requireOneByUid(string $uid) Return the first ChildEmployee filtered by the uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByHash(string $hash) Return the first ChildEmployee filtered by the hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByName(string $name) Return the first ChildEmployee filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByRoleId(int $role_id) Return the first ChildEmployee filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPictureUrl(string $picture_url) Return the first ChildEmployee filtered by the picture_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByIsGradAdvisor(boolean $is_grad_advisor) Return the first ChildEmployee filtered by the is_grad_advisor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByFirstLetter(string $first_letter) Return the first ChildEmployee filtered by the first_letter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByLastLetter(string $last_letter) Return the first ChildEmployee filtered by the last_letter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmployee objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> find(ConnectionInterface $con = null) Return ChildEmployee objects based on current ModelCriteria
 * @method     ChildEmployee[]|ObjectCollection findByUid(string $uid) Return ChildEmployee objects filtered by the uid column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByUid(string $uid) Return ChildEmployee objects filtered by the uid column
 * @method     ChildEmployee[]|ObjectCollection findByHash(string $hash) Return ChildEmployee objects filtered by the hash column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByHash(string $hash) Return ChildEmployee objects filtered by the hash column
 * @method     ChildEmployee[]|ObjectCollection findByName(string $name) Return ChildEmployee objects filtered by the name column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByName(string $name) Return ChildEmployee objects filtered by the name column
 * @method     ChildEmployee[]|ObjectCollection findByRoleId(int $role_id) Return ChildEmployee objects filtered by the role_id column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByRoleId(int $role_id) Return ChildEmployee objects filtered by the role_id column
 * @method     ChildEmployee[]|ObjectCollection findByPictureUrl(string $picture_url) Return ChildEmployee objects filtered by the picture_url column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByPictureUrl(string $picture_url) Return ChildEmployee objects filtered by the picture_url column
 * @method     ChildEmployee[]|ObjectCollection findByIsGradAdvisor(boolean $is_grad_advisor) Return ChildEmployee objects filtered by the is_grad_advisor column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByIsGradAdvisor(boolean $is_grad_advisor) Return ChildEmployee objects filtered by the is_grad_advisor column
 * @method     ChildEmployee[]|ObjectCollection findByFirstLetter(string $first_letter) Return ChildEmployee objects filtered by the first_letter column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByFirstLetter(string $first_letter) Return ChildEmployee objects filtered by the first_letter column
 * @method     ChildEmployee[]|ObjectCollection findByLastLetter(string $last_letter) Return ChildEmployee objects filtered by the last_letter column
 * @psalm-method ObjectCollection&\Traversable<ChildEmployee> findByLastLetter(string $last_letter) Return ChildEmployee objects filtered by the last_letter column
 * @method     ChildEmployee[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmployee> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmployeeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EmployeeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Employee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmployeeQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeQuery();
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployee A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uid, hash, name, role_id, picture_url, is_grad_advisor, first_letter, last_letter FROM employee WHERE uid = :p0';
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
            /** @var ChildEmployee $obj */
            $obj = new ChildEmployee();
            $obj->hydrate($row);
            EmployeeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeTableMap::COL_UID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeTableMap::COL_UID, $keys, Criteria::IN);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByUid($uid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_UID, $uid, $comparison);
    }

    /**
     * Filter the query on the hash column
     *
     * Example usage:
     * <code>
     * $query->filterByHash('fooValue');   // WHERE hash = 'fooValue'
     * $query->filterByHash('%fooValue%', Criteria::LIKE); // WHERE hash LIKE '%fooValue%'
     * $query->filterByHash(['foo', 'bar']); // WHERE hash IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $hash The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByHash($hash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($hash)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_HASH, $hash, $comparison);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleId(1234); // WHERE role_id = 1234
     * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
     * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
     * </code>
     *
     * @see       filterByRole()
     *
     * @param     mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_ROLE_ID, $roleId, $comparison);
    }

    /**
     * Filter the query on the picture_url column
     *
     * Example usage:
     * <code>
     * $query->filterByPictureUrl('fooValue');   // WHERE picture_url = 'fooValue'
     * $query->filterByPictureUrl('%fooValue%', Criteria::LIKE); // WHERE picture_url LIKE '%fooValue%'
     * $query->filterByPictureUrl(['foo', 'bar']); // WHERE picture_url IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $pictureUrl The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByPictureUrl($pictureUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pictureUrl)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_PICTURE_URL, $pictureUrl, $comparison);
    }

    /**
     * Filter the query on the is_grad_advisor column
     *
     * Example usage:
     * <code>
     * $query->filterByIsGradAdvisor(true); // WHERE is_grad_advisor = true
     * $query->filterByIsGradAdvisor('yes'); // WHERE is_grad_advisor = true
     * </code>
     *
     * @param     boolean|string $isGradAdvisor The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByIsGradAdvisor($isGradAdvisor = null, $comparison = null)
    {
        if (is_string($isGradAdvisor)) {
            $isGradAdvisor = in_array(strtolower($isGradAdvisor), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_IS_GRAD_ADVISOR, $isGradAdvisor, $comparison);
    }

    /**
     * Filter the query on the first_letter column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstLetter('fooValue');   // WHERE first_letter = 'fooValue'
     * $query->filterByFirstLetter('%fooValue%', Criteria::LIKE); // WHERE first_letter LIKE '%fooValue%'
     * $query->filterByFirstLetter(['foo', 'bar']); // WHERE first_letter IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $firstLetter The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByFirstLetter($firstLetter = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstLetter)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_FIRST_LETTER, $firstLetter, $comparison);
    }

    /**
     * Filter the query on the last_letter column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLetter('fooValue');   // WHERE last_letter = 'fooValue'
     * $query->filterByLastLetter('%fooValue%', Criteria::LIKE); // WHERE last_letter LIKE '%fooValue%'
     * $query->filterByLastLetter(['foo', 'bar']); // WHERE last_letter IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $lastLetter The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByLastLetter($lastLetter = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastLetter)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeTableMap::COL_LAST_LETTER, $lastLetter, $comparison);
    }

    /**
     * Filter the query by a related \Role object
     *
     * @param \Role|ObjectCollection $role The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByRole($role, $comparison = null)
    {
        if ($role instanceof \Role) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_ROLE_ID, $role->getId(), $comparison);
        } elseif ($role instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmployeeTableMap::COL_ROLE_ID, $role->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRole() only accepts arguments of type \Role or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Role relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinRole($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Role');

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
            $this->addJoinObject($join, 'Role');
        }

        return $this;
    }

    /**
     * Use the Role relation Role object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RoleQuery A secondary query class using the current class as primary query
     */
    public function useRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Role', '\RoleQuery');
    }

    /**
     * Use the Role relation Role object
     *
     * @param callable(\RoleQuery):\RoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Role table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \RoleQuery The inner query object of the EXISTS statement
     */
    public function useRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Role', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Role table for a NOT EXISTS query.
     *
     * @see useRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \RoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Role', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Visit object
     *
     * @param \Visit|ObjectCollection $visit the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByVisit($visit, $comparison = null)
    {
        if ($visit instanceof \Visit) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_UID, $visit->getAdvisorId(), $comparison);
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
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
     * Filter the query by a related \Student object
     *
     * @param \Student|ObjectCollection $student the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByStudent($student, $comparison = null)
    {
        if ($student instanceof \Student) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_UID, $student->getAdvisorId(), $comparison);
        } elseif ($student instanceof ObjectCollection) {
            return $this
                ->useStudentQuery()
                ->filterByPrimaryKeys($student->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinStudent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useStudentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Token object
     *
     * @param \Token|ObjectCollection $token the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByToken($token, $comparison = null)
    {
        if ($token instanceof \Token) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_UID, $token->getEmployeeid(), $comparison);
        } elseif ($token instanceof ObjectCollection) {
            return $this
                ->useTokenQuery()
                ->filterByPrimaryKeys($token->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByToken() only accepts arguments of type \Token or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Token relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinToken($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Token');

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
            $this->addJoinObject($join, 'Token');
        }

        return $this;
    }

    /**
     * Use the Token relation Token object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TokenQuery A secondary query class using the current class as primary query
     */
    public function useTokenQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinToken($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Token', '\TokenQuery');
    }

    /**
     * Use the Token relation Token object
     *
     * @param callable(\TokenQuery):\TokenQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTokenQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTokenQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Token table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \TokenQuery The inner query object of the EXISTS statement
     */
    public function useTokenExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Token', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Token table for a NOT EXISTS query.
     *
     * @see useTokenExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \TokenQuery The inner query object of the NOT EXISTS statement
     */
    public function useTokenNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Token', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \WalkinHour object
     *
     * @param \WalkinHour|ObjectCollection $walkinHour the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByWalkinHour($walkinHour, $comparison = null)
    {
        if ($walkinHour instanceof \WalkinHour) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_UID, $walkinHour->getAdvisorId(), $comparison);
        } elseif ($walkinHour instanceof ObjectCollection) {
            return $this
                ->useWalkinHourQuery()
                ->filterByPrimaryKeys($walkinHour->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByWalkinHour() only accepts arguments of type \WalkinHour or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WalkinHour relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinWalkinHour($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WalkinHour');

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
            $this->addJoinObject($join, 'WalkinHour');
        }

        return $this;
    }

    /**
     * Use the WalkinHour relation WalkinHour object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \WalkinHourQuery A secondary query class using the current class as primary query
     */
    public function useWalkinHourQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWalkinHour($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WalkinHour', '\WalkinHourQuery');
    }

    /**
     * Use the WalkinHour relation WalkinHour object
     *
     * @param callable(\WalkinHourQuery):\WalkinHourQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWalkinHourQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWalkinHourQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to WalkinHour table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \WalkinHourQuery The inner query object of the EXISTS statement
     */
    public function useWalkinHourExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('WalkinHour', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to WalkinHour table for a NOT EXISTS query.
     *
     * @see useWalkinHourExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \WalkinHourQuery The inner query object of the NOT EXISTS statement
     */
    public function useWalkinHourNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('WalkinHour', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Hour object
     *
     * @param \Hour|ObjectCollection $hour the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEmployeeQuery The current query, for fluid interface
     */
    public function filterByHour($hour, $comparison = null)
    {
        if ($hour instanceof \Hour) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_UID, $hour->getAdvisorId(), $comparison);
        } elseif ($hour instanceof ObjectCollection) {
            return $this
                ->useHourQuery()
                ->filterByPrimaryKeys($hour->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHour() only accepts arguments of type \Hour or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Hour relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function joinHour($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Hour');

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
            $this->addJoinObject($join, 'Hour');
        }

        return $this;
    }

    /**
     * Use the Hour relation Hour object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \HourQuery A secondary query class using the current class as primary query
     */
    public function useHourQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHour($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Hour', '\HourQuery');
    }

    /**
     * Use the Hour relation Hour object
     *
     * @param callable(\HourQuery):\HourQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHourQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHourQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Hour table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \HourQuery The inner query object of the EXISTS statement
     */
    public function useHourExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Hour', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Hour table for a NOT EXISTS query.
     *
     * @see useHourExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \HourQuery The inner query object of the NOT EXISTS statement
     */
    public function useHourNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Hour', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildEmployee $employee Object to remove from the list of results
     *
     * @return $this|ChildEmployeeQuery The current query, for fluid interface
     */
    public function prune($employee = null)
    {
        if ($employee) {
            $this->addUsingAlias(EmployeeTableMap::COL_UID, $employee->getUid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeTableMap::clearInstancePool();
            EmployeeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmployeeQuery
