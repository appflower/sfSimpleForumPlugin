<?php

/**
 * Base static class for performing query and update operations on the 'sf_simple_forum_topic' table.
 *
 * 
 *
 * @package    plugins.sfSimpleForumPlugin.lib.model.om
 */
abstract class BasesfSimpleForumTopicPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'sf_simple_forum_topic';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'plugins.sfSimpleForumPlugin.lib.model.sfSimpleForumTopic';

	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the ID field */
	const ID = 'sf_simple_forum_topic.ID';

	/** the column name for the TITLE field */
	const TITLE = 'sf_simple_forum_topic.TITLE';

	/** the column name for the IS_STICKED field */
	const IS_STICKED = 'sf_simple_forum_topic.IS_STICKED';

	/** the column name for the IS_LOCKED field */
	const IS_LOCKED = 'sf_simple_forum_topic.IS_LOCKED';

	/** the column name for the FORUM_ID field */
	const FORUM_ID = 'sf_simple_forum_topic.FORUM_ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'sf_simple_forum_topic.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'sf_simple_forum_topic.UPDATED_AT';

	/** the column name for the LATEST_POST_ID field */
	const LATEST_POST_ID = 'sf_simple_forum_topic.LATEST_POST_ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'sf_simple_forum_topic.USER_ID';

	/** the column name for the STRIPPED_TITLE field */
	const STRIPPED_TITLE = 'sf_simple_forum_topic.STRIPPED_TITLE';

	/** the column name for the IS_RESOLVED field */
	const IS_RESOLVED = 'sf_simple_forum_topic.IS_RESOLVED';

	/** the column name for the NB_POSTS field */
	const NB_POSTS = 'sf_simple_forum_topic.NB_POSTS';

	/** the column name for the NB_VIEWS field */
	const NB_VIEWS = 'sf_simple_forum_topic.NB_VIEWS';

	/**
	 * An identiy map to hold any loaded instances of sfSimpleForumTopic objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array sfSimpleForumTopic[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'IsSticked', 'IsLocked', 'ForumId', 'CreatedAt', 'UpdatedAt', 'LatestPostId', 'UserId', 'StrippedTitle', 'IsResolved', 'NbPosts', 'NbViews', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'title', 'isSticked', 'isLocked', 'forumId', 'createdAt', 'updatedAt', 'latestPostId', 'userId', 'strippedTitle', 'isResolved', 'nbPosts', 'nbViews', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::TITLE, self::IS_STICKED, self::IS_LOCKED, self::FORUM_ID, self::CREATED_AT, self::UPDATED_AT, self::LATEST_POST_ID, self::USER_ID, self::STRIPPED_TITLE, self::IS_RESOLVED, self::NB_POSTS, self::NB_VIEWS, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'is_sticked', 'is_locked', 'forum_id', 'created_at', 'updated_at', 'latest_post_id', 'user_id', 'stripped_title', 'is_resolved', 'nb_posts', 'nb_views', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'IsSticked' => 2, 'IsLocked' => 3, 'ForumId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'LatestPostId' => 7, 'UserId' => 8, 'StrippedTitle' => 9, 'IsResolved' => 10, 'NbPosts' => 11, 'NbViews' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'title' => 1, 'isSticked' => 2, 'isLocked' => 3, 'forumId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'latestPostId' => 7, 'userId' => 8, 'strippedTitle' => 9, 'isResolved' => 10, 'nbPosts' => 11, 'nbViews' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::TITLE => 1, self::IS_STICKED => 2, self::IS_LOCKED => 3, self::FORUM_ID => 4, self::CREATED_AT => 5, self::UPDATED_AT => 6, self::LATEST_POST_ID => 7, self::USER_ID => 8, self::STRIPPED_TITLE => 9, self::IS_RESOLVED => 10, self::NB_POSTS => 11, self::NB_VIEWS => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'is_sticked' => 2, 'is_locked' => 3, 'forum_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'latest_post_id' => 7, 'user_id' => 8, 'stripped_title' => 9, 'is_resolved' => 10, 'nb_posts' => 11, 'nb_views' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new sfSimpleForumTopicMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. sfSimpleForumTopicPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(sfSimpleForumTopicPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::TITLE);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::IS_STICKED);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::IS_LOCKED);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::FORUM_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::CREATED_AT);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::UPDATED_AT);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::LATEST_POST_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::USER_ID);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::STRIPPED_TITLE);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::IS_RESOLVED);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::NB_POSTS);

		$criteria->addSelectColumn(sfSimpleForumTopicPeer::NB_VIEWS);

	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(sfSimpleForumTopicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     sfSimpleForumTopic
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = sfSimpleForumTopicPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return sfSimpleForumTopicPeer::populateObjects(sfSimpleForumTopicPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      sfSimpleForumTopic $value A sfSimpleForumTopic object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(sfSimpleForumTopic $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A sfSimpleForumTopic object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof sfSimpleForumTopic) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or sfSimpleForumTopic object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     sfSimpleForumTopic Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = sfSimpleForumTopicPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = sfSimpleForumTopicPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				sfSimpleForumTopicPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related sfSimpleForumForum table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinsfSimpleForumForum(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(sfSimpleForumTopicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related sfSimpleForumPost table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinsfSimpleForumPost(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(sfSimpleForumTopicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related sfGuardUser table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(sfSimpleForumTopicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);


    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of sfSimpleForumTopic objects pre-filled with their sfSimpleForumForum objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfSimpleForumTopic objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinsfSimpleForumForum(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $c, $con);
    }


		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS);
		sfSimpleForumForumPeer::addSelectColumns($c);

		$c->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfSimpleForumTopicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = sfSimpleForumTopicPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfSimpleForumTopicPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = sfSimpleForumForumPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = sfSimpleForumForumPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfSimpleForumForumPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					sfSimpleForumForumPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to $obj2 (sfSimpleForumForum)
				$obj2->addsfSimpleForumTopic($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of sfSimpleForumTopic objects pre-filled with their sfSimpleForumPost objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfSimpleForumTopic objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinsfSimpleForumPost(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS);
		sfSimpleForumPostPeer::addSelectColumns($c);

		$c->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfSimpleForumTopicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = sfSimpleForumTopicPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfSimpleForumTopicPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = sfSimpleForumPostPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = sfSimpleForumPostPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfSimpleForumPostPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					sfSimpleForumPostPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to $obj2 (sfSimpleForumPost)
				$obj2->addsfSimpleForumTopic($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of sfSimpleForumTopic objects pre-filled with their sfGuardUser objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfSimpleForumTopic objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS);
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfSimpleForumTopicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = sfSimpleForumTopicPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfSimpleForumTopicPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = sfGuardUserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfGuardUserPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					sfGuardUserPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to $obj2 (sfGuardUser)
				$obj2->addsfSimpleForumTopic($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(sfSimpleForumTopicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);
		$criteria->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);
		$criteria->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of sfSimpleForumTopic objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfSimpleForumTopic objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $c, $con);
    }


		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS);

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS);

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);
		$c->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);
		$c->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfSimpleForumTopicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = sfSimpleForumTopicPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfSimpleForumTopicPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined sfSimpleForumForum rows

			$key2 = sfSimpleForumForumPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = sfSimpleForumForumPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = sfSimpleForumForumPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfSimpleForumForumPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj2 (sfSimpleForumForum)
				$obj2->addsfSimpleForumTopic($obj1);
			} // if joined row not null

			// Add objects for joined sfSimpleForumPost rows

			$key3 = sfSimpleForumPostPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = sfSimpleForumPostPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = sfSimpleForumPostPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfSimpleForumPostPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj3 (sfSimpleForumPost)
				$obj3->addsfSimpleForumTopic($obj1);
			} // if joined row not null

			// Add objects for joined sfGuardUser rows

			$key4 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = sfGuardUserPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					sfGuardUserPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj4 (sfGuardUser)
				$obj4->addsfSimpleForumTopic($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related sfSimpleForumForum table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptsfSimpleForumForum(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);
				$criteria->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related sfSimpleForumPost table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptsfSimpleForumPost(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);
				$criteria->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related sfGuardUser table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptsfGuardUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			sfSimpleForumTopicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);
				$criteria->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of sfSimpleForumTopic objects pre-filled with all related objects except sfSimpleForumForum.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfSimpleForumTopic objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptsfSimpleForumForum(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $c, $con);
    }


		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS);

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);
				$c->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfSimpleForumTopicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = sfSimpleForumTopicPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfSimpleForumTopicPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfSimpleForumPost rows

				$key2 = sfSimpleForumPostPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfSimpleForumPostPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = sfSimpleForumPostPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfSimpleForumPostPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj2 (sfSimpleForumPost)
				$obj2->addsfSimpleForumTopic($obj1);

			} // if joined row is not null

				// Add objects for joined sfGuardUser rows

				$key3 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfGuardUserPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj3 (sfGuardUser)
				$obj3->addsfSimpleForumTopic($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of sfSimpleForumTopic objects pre-filled with all related objects except sfSimpleForumPost.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfSimpleForumTopic objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptsfSimpleForumPost(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS);

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS);

		sfGuardUserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfGuardUserPeer::NUM_COLUMNS - sfGuardUserPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);
				$c->addJoin(array(sfSimpleForumTopicPeer::USER_ID,), array(sfGuardUserPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfSimpleForumTopicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = sfSimpleForumTopicPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfSimpleForumTopicPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfSimpleForumForum rows

				$key2 = sfSimpleForumForumPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfSimpleForumForumPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = sfSimpleForumForumPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfSimpleForumForumPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj2 (sfSimpleForumForum)
				$obj2->addsfSimpleForumTopic($obj1);

			} // if joined row is not null

				// Add objects for joined sfGuardUser rows

				$key3 = sfGuardUserPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfGuardUserPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = sfGuardUserPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfGuardUserPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj3 (sfGuardUser)
				$obj3->addsfSimpleForumTopic($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of sfSimpleForumTopic objects pre-filled with all related objects except sfGuardUser.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of sfSimpleForumTopic objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptsfGuardUser(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfSimpleForumTopicPeer::addSelectColumns($c);
		$startcol2 = (sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS);

		sfSimpleForumForumPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS);

		sfSimpleForumPostPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(sfSimpleForumTopicPeer::FORUM_ID,), array(sfSimpleForumForumPeer::ID,), $join_behavior);
				$c->addJoin(array(sfSimpleForumTopicPeer::LATEST_POST_ID,), array(sfSimpleForumPostPeer::ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = sfSimpleForumTopicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = sfSimpleForumTopicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = sfSimpleForumTopicPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				sfSimpleForumTopicPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined sfSimpleForumForum rows

				$key2 = sfSimpleForumForumPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = sfSimpleForumForumPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = sfSimpleForumForumPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					sfSimpleForumForumPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj2 (sfSimpleForumForum)
				$obj2->addsfSimpleForumTopic($obj1);

			} // if joined row is not null

				// Add objects for joined sfSimpleForumPost rows

				$key3 = sfSimpleForumPostPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = sfSimpleForumPostPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = sfSimpleForumPostPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					sfSimpleForumPostPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (sfSimpleForumTopic) to the collection in $obj3 (sfSimpleForumPost)
				$obj3->addsfSimpleForumTopic($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return sfSimpleForumTopicPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a sfSimpleForumTopic or Criteria object.
	 *
	 * @param      mixed $values Criteria or sfSimpleForumTopic object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from sfSimpleForumTopic object
		}

		if ($criteria->containsKey(sfSimpleForumTopicPeer::ID) && $criteria->keyContainsValue(sfSimpleForumTopicPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.sfSimpleForumTopicPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a sfSimpleForumTopic or Criteria object.
	 *
	 * @param      mixed $values Criteria or sfSimpleForumTopic object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(sfSimpleForumTopicPeer::ID);
			$selectCriteria->add(sfSimpleForumTopicPeer::ID, $criteria->remove(sfSimpleForumTopicPeer::ID), $comparison);

		} else { // $values is sfSimpleForumTopic object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasesfSimpleForumTopicPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasesfSimpleForumTopicPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the sf_simple_forum_topic table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += sfSimpleForumTopicPeer::doOnDeleteCascade(new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(sfSimpleForumTopicPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a sfSimpleForumTopic or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or sfSimpleForumTopic object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			sfSimpleForumTopicPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof sfSimpleForumTopic) {
			// invalidate the cache for this single object
			sfSimpleForumTopicPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfSimpleForumTopicPeer::ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				sfSimpleForumTopicPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += sfSimpleForumTopicPeer::doOnDeleteCascade($criteria, $con);
			
				// Because this db requires some delete cascade/set null emulation, we have to
				// clear the cached instance *after* the emulation has happened (since
				// instances get re-added by the select statement contained therein).
				if ($values instanceof Criteria) {
					sfSimpleForumTopicPeer::clearInstancePool();
				} else { // it's a PK or object
					sfSimpleForumTopicPeer::removeInstanceFromPool($values);
				}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			// invalidate objects in sfSimpleForumPostPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			sfSimpleForumPostPeer::clearInstancePool();

			// invalidate objects in sfSimpleForumTopicViewPeer instance pool, since one or more of them may be deleted by ON DELETE CASCADE rule.
			sfSimpleForumTopicViewPeer::clearInstancePool();

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      PropelPDO $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = sfSimpleForumTopicPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related sfSimpleForumPost objects
			$c = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
			
			$c->add(sfSimpleForumPostPeer::TOPIC_ID, $obj->getId());
			$affectedRows += sfSimpleForumPostPeer::doDelete($c, $con);

			// delete related sfSimpleForumTopicView objects
			$c = new Criteria(sfSimpleForumTopicViewPeer::DATABASE_NAME);
			
			$c->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $obj->getId());
			$affectedRows += sfSimpleForumTopicViewPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given sfSimpleForumTopic object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      sfSimpleForumTopic $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(sfSimpleForumTopic $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfSimpleForumTopicPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfSimpleForumTopicPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(sfSimpleForumTopicPeer::DATABASE_NAME, sfSimpleForumTopicPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfSimpleForumTopicPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     sfSimpleForumTopic
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = sfSimpleForumTopicPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
		$criteria->add(sfSimpleForumTopicPeer::ID, $pk);

		$v = sfSimpleForumTopicPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
			$criteria->add(sfSimpleForumTopicPeer::ID, $pks, Criteria::IN);
			$objs = sfSimpleForumTopicPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BasesfSimpleForumTopicPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the sfSimpleForumTopicPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the sfSimpleForumTopicPeer class:
//
// Propel::getDatabaseMap(sfSimpleForumTopicPeer::DATABASE_NAME)->addTableBuilder(sfSimpleForumTopicPeer::TABLE_NAME, sfSimpleForumTopicPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BasesfSimpleForumTopicPeer::DATABASE_NAME)->addTableBuilder(BasesfSimpleForumTopicPeer::TABLE_NAME, BasesfSimpleForumTopicPeer::getMapBuilder());

