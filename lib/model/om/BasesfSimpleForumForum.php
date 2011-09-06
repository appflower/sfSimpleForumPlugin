<?php

/**
 * Base class that represents a row from the 'sf_simple_forum_forum' table.
 *
 * 
 *
 * @package    plugins.sfSimpleForumPlugin.lib.model.om
 */
abstract class BasesfSimpleForumForum extends BaseObject  implements Persistent {


  const PEER = 'sfSimpleForumForumPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        sfSimpleForumForumPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank;

	/**
	 * The value for the category_id field.
	 * @var        int
	 */
	protected $category_id;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * The value for the stripped_name field.
	 * @var        string
	 */
	protected $stripped_name;

	/**
	 * The value for the latest_post_id field.
	 * @var        int
	 */
	protected $latest_post_id;

	/**
	 * The value for the nb_posts field.
	 * @var        int
	 */
	protected $nb_posts;

	/**
	 * The value for the nb_topics field.
	 * @var        int
	 */
	protected $nb_topics;

	/**
	 * @var        sfSimpleForumCategory
	 */
	protected $asfSimpleForumCategory;

	/**
	 * @var        sfSimpleForumPost
	 */
	protected $asfSimpleForumPost;

	/**
	 * @var        array sfSimpleForumTopic[] Collection to store aggregation of sfSimpleForumTopic objects.
	 */
	protected $collsfSimpleForumTopics;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfSimpleForumTopics.
	 */
	private $lastsfSimpleForumTopicCriteria = null;

	/**
	 * @var        array sfSimpleForumPost[] Collection to store aggregation of sfSimpleForumPost objects.
	 */
	protected $collsfSimpleForumPosts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfSimpleForumPosts.
	 */
	private $lastsfSimpleForumPostCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of BasesfSimpleForumForum object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [rank] column value.
	 * 
	 * @return     int
	 */
	public function getRank()
	{
		return $this->rank;
	}

	/**
	 * Get the [category_id] column value.
	 * 
	 * @return     int
	 */
	public function getCategoryId()
	{
		return $this->category_id;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [stripped_name] column value.
	 * 
	 * @return     string
	 */
	public function getStrippedName()
	{
		return $this->stripped_name;
	}

	/**
	 * Get the [latest_post_id] column value.
	 * 
	 * @return     int
	 */
	public function getLatestPostId()
	{
		return $this->latest_post_id;
	}

	/**
	 * Get the [nb_posts] column value.
	 * 
	 * @return     int
	 */
	public function getNbPosts()
	{
		return $this->nb_posts;
	}

	/**
	 * Get the [nb_topics] column value.
	 * 
	 * @return     int
	 */
	public function getNbTopics()
	{
		return $this->nb_topics;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [rank] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setRank($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rank !== $v) {
			$this->rank = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::RANK;
		}

		return $this;
	} // setRank()

	/**
	 * Set the value of [category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::CATEGORY_ID;
		}

		if ($this->asfSimpleForumCategory !== null && $this->asfSimpleForumCategory->getId() !== $v) {
			$this->asfSimpleForumCategory = null;
		}

		return $this;
	} // setCategoryId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = sfSimpleForumForumPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = sfSimpleForumForumPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Set the value of [stripped_name] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setStrippedName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->stripped_name !== $v) {
			$this->stripped_name = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::STRIPPED_NAME;
		}

		return $this;
	} // setStrippedName()

	/**
	 * Set the value of [latest_post_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setLatestPostId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->latest_post_id !== $v) {
			$this->latest_post_id = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::LATEST_POST_ID;
		}

		if ($this->asfSimpleForumPost !== null && $this->asfSimpleForumPost->getId() !== $v) {
			$this->asfSimpleForumPost = null;
		}

		return $this;
	} // setLatestPostId()

	/**
	 * Set the value of [nb_posts] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setNbPosts($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->nb_posts !== $v) {
			$this->nb_posts = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NB_POSTS;
		}

		return $this;
	} // setNbPosts()

	/**
	 * Set the value of [nb_topics] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 */
	public function setNbTopics($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->nb_topics !== $v) {
			$this->nb_topics = $v;
			$this->modifiedColumns[] = sfSimpleForumForumPeer::NB_TOPICS;
		}

		return $this;
	} // setNbTopics()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

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
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->rank = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->category_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->updated_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->stripped_name = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->latest_post_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->nb_posts = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->nb_topics = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = sfSimpleForumForumPeer::NUM_COLUMNS - sfSimpleForumForumPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumForum object", $e);
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
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->asfSimpleForumCategory !== null && $this->category_id !== $this->asfSimpleForumCategory->getId()) {
			$this->asfSimpleForumCategory = null;
		}
		if ($this->asfSimpleForumPost !== null && $this->latest_post_id !== $this->asfSimpleForumPost->getId()) {
			$this->asfSimpleForumPost = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = sfSimpleForumForumPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->asfSimpleForumCategory = null;
			$this->asfSimpleForumPost = null;
			$this->collsfSimpleForumTopics = null;
			$this->lastsfSimpleForumTopicCriteria = null;

			$this->collsfSimpleForumPosts = null;
			$this->lastsfSimpleForumPostCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumForum:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			sfSimpleForumForumPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfSimpleForumForum:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasesfSimpleForumForum:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumForumPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(sfSimpleForumForumPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumForumPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfSimpleForumForum:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			sfSimpleForumForumPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->asfSimpleForumCategory !== null) {
				if ($this->asfSimpleForumCategory->isModified() || $this->asfSimpleForumCategory->isNew()) {
					$affectedRows += $this->asfSimpleForumCategory->save($con);
				}
				$this->setsfSimpleForumCategory($this->asfSimpleForumCategory);
			}

			if ($this->asfSimpleForumPost !== null) {
				if ($this->asfSimpleForumPost->isModified() || $this->asfSimpleForumPost->isNew()) {
					$affectedRows += $this->asfSimpleForumPost->save($con);
				}
				$this->setsfSimpleForumPost($this->asfSimpleForumPost);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = sfSimpleForumForumPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumForumPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumForumPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collsfSimpleForumTopics !== null) {
				foreach ($this->collsfSimpleForumTopics as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfSimpleForumPosts !== null) {
				foreach ($this->collsfSimpleForumPosts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->asfSimpleForumCategory !== null) {
				if (!$this->asfSimpleForumCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumCategory->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumPost !== null) {
				if (!$this->asfSimpleForumPost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumPost->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumForumPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumTopics !== null) {
					foreach ($this->collsfSimpleForumTopics as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfSimpleForumPosts !== null) {
					foreach ($this->collsfSimpleForumPosts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getRank();
				break;
			case 4:
				return $this->getCategoryId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getStrippedName();
				break;
			case 8:
				return $this->getLatestPostId();
				break;
			case 9:
				return $this->getNbPosts();
				break;
			case 10:
				return $this->getNbTopics();
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = sfSimpleForumForumPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getRank(),
			$keys[4] => $this->getCategoryId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getStrippedName(),
			$keys[8] => $this->getLatestPostId(),
			$keys[9] => $this->getNbPosts(),
			$keys[10] => $this->getNbTopics(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = sfSimpleForumForumPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setRank($value);
				break;
			case 4:
				$this->setCategoryId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setStrippedName($value);
				break;
			case 8:
				$this->setLatestPostId($value);
				break;
			case 9:
				$this->setNbPosts($value);
				break;
			case 10:
				$this->setNbTopics($value);
				break;
		} // switch()
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
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = sfSimpleForumForumPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCategoryId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStrippedName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLatestPostId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNbPosts($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setNbTopics($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumForumPeer::ID)) $criteria->add(sfSimpleForumForumPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NAME)) $criteria->add(sfSimpleForumForumPeer::NAME, $this->name);
		if ($this->isColumnModified(sfSimpleForumForumPeer::DESCRIPTION)) $criteria->add(sfSimpleForumForumPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(sfSimpleForumForumPeer::RANK)) $criteria->add(sfSimpleForumForumPeer::RANK, $this->rank);
		if ($this->isColumnModified(sfSimpleForumForumPeer::CATEGORY_ID)) $criteria->add(sfSimpleForumForumPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::CREATED_AT)) $criteria->add(sfSimpleForumForumPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumForumPeer::UPDATED_AT)) $criteria->add(sfSimpleForumForumPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(sfSimpleForumForumPeer::STRIPPED_NAME)) $criteria->add(sfSimpleForumForumPeer::STRIPPED_NAME, $this->stripped_name);
		if ($this->isColumnModified(sfSimpleForumForumPeer::LATEST_POST_ID)) $criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->latest_post_id);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NB_POSTS)) $criteria->add(sfSimpleForumForumPeer::NB_POSTS, $this->nb_posts);
		if ($this->isColumnModified(sfSimpleForumForumPeer::NB_TOPICS)) $criteria->add(sfSimpleForumForumPeer::NB_TOPICS, $this->nb_topics);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumForumPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of sfSimpleForumForum (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setRank($this->rank);

		$copyObj->setCategoryId($this->category_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setStrippedName($this->stripped_name);

		$copyObj->setLatestPostId($this->latest_post_id);

		$copyObj->setNbPosts($this->nb_posts);

		$copyObj->setNbTopics($this->nb_topics);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getsfSimpleForumTopics() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfSimpleForumTopic($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfSimpleForumPosts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfSimpleForumPost($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     sfSimpleForumForum Clone of current object.
	 * @throws     PropelException
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
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     sfSimpleForumForumPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfSimpleForumForumPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a sfSimpleForumCategory object.
	 *
	 * @param      sfSimpleForumCategory $v
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfSimpleForumCategory(sfSimpleForumCategory $v = null)
	{
		if ($v === null) {
			$this->setCategoryId(NULL);
		} else {
			$this->setCategoryId($v->getId());
		}

		$this->asfSimpleForumCategory = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfSimpleForumCategory object, it will not be re-added.
		if ($v !== null) {
			$v->addsfSimpleForumForum($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfSimpleForumCategory object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfSimpleForumCategory The associated sfSimpleForumCategory object.
	 * @throws     PropelException
	 */
	public function getsfSimpleForumCategory(PropelPDO $con = null)
	{
		if ($this->asfSimpleForumCategory === null && ($this->category_id !== null)) {
			$c = new Criteria(sfSimpleForumCategoryPeer::DATABASE_NAME);
			$c->add(sfSimpleForumCategoryPeer::ID, $this->category_id);
			$this->asfSimpleForumCategory = sfSimpleForumCategoryPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfSimpleForumCategory->addsfSimpleForumForums($this);
			 */
		}
		return $this->asfSimpleForumCategory;
	}

	/**
	 * Declares an association between this object and a sfSimpleForumPost object.
	 *
	 * @param      sfSimpleForumPost $v
	 * @return     sfSimpleForumForum The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfSimpleForumPost(sfSimpleForumPost $v = null)
	{
		if ($v === null) {
			$this->setLatestPostId(NULL);
		} else {
			$this->setLatestPostId($v->getId());
		}

		$this->asfSimpleForumPost = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfSimpleForumPost object, it will not be re-added.
		if ($v !== null) {
			$v->addsfSimpleForumForum($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfSimpleForumPost object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfSimpleForumPost The associated sfSimpleForumPost object.
	 * @throws     PropelException
	 */
	public function getsfSimpleForumPost(PropelPDO $con = null)
	{
		if ($this->asfSimpleForumPost === null && ($this->latest_post_id !== null)) {
			$c = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
			$c->add(sfSimpleForumPostPeer::ID, $this->latest_post_id);
			$this->asfSimpleForumPost = sfSimpleForumPostPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfSimpleForumPost->addsfSimpleForumForums($this);
			 */
		}
		return $this->asfSimpleForumPost;
	}

	/**
	 * Clears out the collsfSimpleForumTopics collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfSimpleForumTopics()
	 */
	public function clearsfSimpleForumTopics()
	{
		$this->collsfSimpleForumTopics = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfSimpleForumTopics collection (array).
	 *
	 * By default this just sets the collsfSimpleForumTopics collection to an empty array (like clearcollsfSimpleForumTopics());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfSimpleForumTopics()
	{
		$this->collsfSimpleForumTopics = array();
	}

	/**
	 * Gets an array of sfSimpleForumTopic objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumForum has previously been saved, it will retrieve
	 * related sfSimpleForumTopics from storage. If this sfSimpleForumForum is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfSimpleForumTopic[]
	 * @throws     PropelException
	 */
	public function getsfSimpleForumTopics($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

				sfSimpleForumTopicPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

				sfSimpleForumTopicPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
					$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;
		return $this->collsfSimpleForumTopics;
	}

	/**
	 * Returns the number of related sfSimpleForumTopic objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfSimpleForumTopic objects.
	 * @throws     PropelException
	 */
	public function countsfSimpleForumTopics(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

				$count = sfSimpleForumTopicPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

				if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
					$count = sfSimpleForumTopicPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfSimpleForumTopics);
				}
			} else {
				$count = count($this->collsfSimpleForumTopics);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfSimpleForumTopic object to this object
	 * through the sfSimpleForumTopic foreign key attribute.
	 *
	 * @param      sfSimpleForumTopic $l sfSimpleForumTopic
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfSimpleForumTopic(sfSimpleForumTopic $l)
	{
		if ($this->collsfSimpleForumTopics === null) {
			$this->initsfSimpleForumTopics();
		}
		if (!in_array($l, $this->collsfSimpleForumTopics, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfSimpleForumTopics, $l);
			$l->setsfSimpleForumForum($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumForum is new, it will return
	 * an empty collection; or if this sfSimpleForumForum has previously
	 * been saved, it will retrieve related sfSimpleForumTopics from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumForum.
	 */
	public function getsfSimpleForumTopicsJoinsfSimpleForumPost($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumPost($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumPost($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumForum is new, it will return
	 * an empty collection; or if this sfSimpleForumForum has previously
	 * been saved, it will retrieve related sfSimpleForumTopics from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumForum.
	 */
	public function getsfSimpleForumTopicsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->id);

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
	}

	/**
	 * Clears out the collsfSimpleForumPosts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfSimpleForumPosts()
	 */
	public function clearsfSimpleForumPosts()
	{
		$this->collsfSimpleForumPosts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfSimpleForumPosts collection (array).
	 *
	 * By default this just sets the collsfSimpleForumPosts collection to an empty array (like clearcollsfSimpleForumPosts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfSimpleForumPosts()
	{
		$this->collsfSimpleForumPosts = array();
	}

	/**
	 * Gets an array of sfSimpleForumPost objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumForum has previously been saved, it will retrieve
	 * related sfSimpleForumPosts from storage. If this sfSimpleForumForum is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfSimpleForumPost[]
	 * @throws     PropelException
	 */
	public function getsfSimpleForumPosts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
					$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;
		return $this->collsfSimpleForumPosts;
	}

	/**
	 * Returns the number of related sfSimpleForumPost objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfSimpleForumPost objects.
	 * @throws     PropelException
	 */
	public function countsfSimpleForumPosts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

				$count = sfSimpleForumPostPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

				if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
					$count = sfSimpleForumPostPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfSimpleForumPosts);
				}
			} else {
				$count = count($this->collsfSimpleForumPosts);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfSimpleForumPost object to this object
	 * through the sfSimpleForumPost foreign key attribute.
	 *
	 * @param      sfSimpleForumPost $l sfSimpleForumPost
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfSimpleForumPost(sfSimpleForumPost $l)
	{
		if ($this->collsfSimpleForumPosts === null) {
			$this->initsfSimpleForumPosts();
		}
		if (!in_array($l, $this->collsfSimpleForumPosts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfSimpleForumPosts, $l);
			$l->setsfSimpleForumForum($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumForum is new, it will return
	 * an empty collection; or if this sfSimpleForumForum has previously
	 * been saved, it will retrieve related sfSimpleForumPosts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumForum.
	 */
	public function getsfSimpleForumPostsJoinsfSimpleForumTopic($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumTopic($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumTopic($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumForum is new, it will return
	 * an empty collection; or if this sfSimpleForumForum has previously
	 * been saved, it will retrieve related sfSimpleForumPosts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumForum.
	 */
	public function getsfSimpleForumPostsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->id);

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collsfSimpleForumTopics) {
				foreach ((array) $this->collsfSimpleForumTopics as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfSimpleForumPosts) {
				foreach ((array) $this->collsfSimpleForumPosts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collsfSimpleForumTopics = null;
		$this->collsfSimpleForumPosts = null;
			$this->asfSimpleForumCategory = null;
			$this->asfSimpleForumPost = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfSimpleForumForum:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfSimpleForumForum::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasesfSimpleForumForum
