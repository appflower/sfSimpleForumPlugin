<?php

/**
 * Base class that represents a row from the 'sf_simple_forum_topic' table.
 *
 * 
 *
 * @package    plugins.sfSimpleForumPlugin.lib.model.om
 */
abstract class BasesfSimpleForumTopic extends BaseObject  implements Persistent {


  const PEER = 'sfSimpleForumTopicPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        sfSimpleForumTopicPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the is_sticked field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_sticked;

	/**
	 * The value for the is_locked field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_locked;

	/**
	 * The value for the forum_id field.
	 * @var        int
	 */
	protected $forum_id;

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
	 * The value for the latest_post_id field.
	 * @var        int
	 */
	protected $latest_post_id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the stripped_title field.
	 * @var        string
	 */
	protected $stripped_title;

	/**
	 * The value for the is_resolved field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_resolved;

	/**
	 * The value for the nb_posts field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $nb_posts;

	/**
	 * The value for the nb_views field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $nb_views;

	/**
	 * @var        sfSimpleForumForum
	 */
	protected $asfSimpleForumForum;

	/**
	 * @var        sfSimpleForumPost
	 */
	protected $asfSimpleForumPost;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        array sfSimpleForumPost[] Collection to store aggregation of sfSimpleForumPost objects.
	 */
	protected $collsfSimpleForumPosts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfSimpleForumPosts.
	 */
	private $lastsfSimpleForumPostCriteria = null;

	/**
	 * @var        array sfSimpleForumTopicView[] Collection to store aggregation of sfSimpleForumTopicView objects.
	 */
	protected $collsfSimpleForumTopicViews;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfSimpleForumTopicViews.
	 */
	private $lastsfSimpleForumTopicViewCriteria = null;

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
	 * Initializes internal state of BasesfSimpleForumTopic object.
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
		$this->is_sticked = false;
		$this->is_locked = false;
		$this->is_resolved = false;
		$this->nb_posts = 0;
		$this->nb_views = 0;
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
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [is_sticked] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsSticked()
	{
		return $this->is_sticked;
	}

	/**
	 * Get the [is_locked] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsLocked()
	{
		return $this->is_locked;
	}

	/**
	 * Get the [forum_id] column value.
	 * 
	 * @return     int
	 */
	public function getForumId()
	{
		return $this->forum_id;
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
	 * Get the [latest_post_id] column value.
	 * 
	 * @return     int
	 */
	public function getLatestPostId()
	{
		return $this->latest_post_id;
	}

	/**
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [stripped_title] column value.
	 * 
	 * @return     string
	 */
	public function getStrippedTitle()
	{
		return $this->stripped_title;
	}

	/**
	 * Get the [is_resolved] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsResolved()
	{
		return $this->is_resolved;
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
	 * Get the [nb_views] column value.
	 * 
	 * @return     int
	 */
	public function getNbViews()
	{
		return $this->nb_views;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [is_sticked] column.
	 * 
	 * @param      boolean $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setIsSticked($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_sticked !== $v || $v === false) {
			$this->is_sticked = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::IS_STICKED;
		}

		return $this;
	} // setIsSticked()

	/**
	 * Set the value of [is_locked] column.
	 * 
	 * @param      boolean $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setIsLocked($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_locked !== $v || $v === false) {
			$this->is_locked = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::IS_LOCKED;
		}

		return $this;
	} // setIsLocked()

	/**
	 * Set the value of [forum_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setForumId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->forum_id !== $v) {
			$this->forum_id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::FORUM_ID;
		}

		if ($this->asfSimpleForumForum !== null && $this->asfSimpleForumForum->getId() !== $v) {
			$this->asfSimpleForumForum = null;
		}

		return $this;
	} // setForumId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
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
				$this->modifiedColumns[] = sfSimpleForumTopicPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
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
				$this->modifiedColumns[] = sfSimpleForumTopicPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Set the value of [latest_post_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setLatestPostId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->latest_post_id !== $v) {
			$this->latest_post_id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::LATEST_POST_ID;
		}

		if ($this->asfSimpleForumPost !== null && $this->asfSimpleForumPost->getId() !== $v) {
			$this->asfSimpleForumPost = null;
		}

		return $this;
	} // setLatestPostId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [stripped_title] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setStrippedTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->stripped_title !== $v) {
			$this->stripped_title = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::STRIPPED_TITLE;
		}

		return $this;
	} // setStrippedTitle()

	/**
	 * Set the value of [is_resolved] column.
	 * 
	 * @param      boolean $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setIsResolved($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_resolved !== $v || $v === false) {
			$this->is_resolved = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::IS_RESOLVED;
		}

		return $this;
	} // setIsResolved()

	/**
	 * Set the value of [nb_posts] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setNbPosts($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->nb_posts !== $v || $v === 0) {
			$this->nb_posts = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::NB_POSTS;
		}

		return $this;
	} // setNbPosts()

	/**
	 * Set the value of [nb_views] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 */
	public function setNbViews($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->nb_views !== $v || $v === 0) {
			$this->nb_views = $v;
			$this->modifiedColumns[] = sfSimpleForumTopicPeer::NB_VIEWS;
		}

		return $this;
	} // setNbViews()

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
			if (array_diff($this->modifiedColumns, array(sfSimpleForumTopicPeer::IS_STICKED,sfSimpleForumTopicPeer::IS_LOCKED,sfSimpleForumTopicPeer::IS_RESOLVED,sfSimpleForumTopicPeer::NB_POSTS,sfSimpleForumTopicPeer::NB_VIEWS))) {
				return false;
			}

			if ($this->is_sticked !== false) {
				return false;
			}

			if ($this->is_locked !== false) {
				return false;
			}

			if ($this->is_resolved !== false) {
				return false;
			}

			if ($this->nb_posts !== 0) {
				return false;
			}

			if ($this->nb_views !== 0) {
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
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->is_sticked = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->is_locked = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->forum_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->updated_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->latest_post_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->user_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->stripped_title = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->is_resolved = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
			$this->nb_posts = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->nb_views = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = sfSimpleForumTopicPeer::NUM_COLUMNS - sfSimpleForumTopicPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumTopic object", $e);
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

		if ($this->asfSimpleForumForum !== null && $this->forum_id !== $this->asfSimpleForumForum->getId()) {
			$this->asfSimpleForumForum = null;
		}
		if ($this->asfSimpleForumPost !== null && $this->latest_post_id !== $this->asfSimpleForumPost->getId()) {
			$this->asfSimpleForumPost = null;
		}
		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
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
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = sfSimpleForumTopicPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->asfSimpleForumForum = null;
			$this->asfSimpleForumPost = null;
			$this->asfGuardUser = null;
			$this->collsfSimpleForumPosts = null;
			$this->lastsfSimpleForumPostCriteria = null;

			$this->collsfSimpleForumTopicViews = null;
			$this->lastsfSimpleForumTopicViewCriteria = null;

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

    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			sfSimpleForumTopicPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumTopicPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(sfSimpleForumTopicPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumTopicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfSimpleForumTopic:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			sfSimpleForumTopicPeer::addInstanceToPool($this);
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

			if ($this->asfSimpleForumForum !== null) {
				if ($this->asfSimpleForumForum->isModified() || $this->asfSimpleForumForum->isNew()) {
					$affectedRows += $this->asfSimpleForumForum->save($con);
				}
				$this->setsfSimpleForumForum($this->asfSimpleForumForum);
			}

			if ($this->asfSimpleForumPost !== null) {
				if ($this->asfSimpleForumPost->isModified() || $this->asfSimpleForumPost->isNew()) {
					$affectedRows += $this->asfSimpleForumPost->save($con);
				}
				$this->setsfSimpleForumPost($this->asfSimpleForumPost);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = sfSimpleForumTopicPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumTopicPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumTopicPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collsfSimpleForumPosts !== null) {
				foreach ($this->collsfSimpleForumPosts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfSimpleForumTopicViews !== null) {
				foreach ($this->collsfSimpleForumTopicViews as $referrerFK) {
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

			if ($this->asfSimpleForumForum !== null) {
				if (!$this->asfSimpleForumForum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumForum->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumPost !== null) {
				if (!$this->asfSimpleForumPost->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumPost->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumTopicPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumPosts !== null) {
					foreach ($this->collsfSimpleForumPosts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfSimpleForumTopicViews !== null) {
					foreach ($this->collsfSimpleForumTopicViews as $referrerFK) {
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
		$pos = sfSimpleForumTopicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 2:
				return $this->getIsSticked();
				break;
			case 3:
				return $this->getIsLocked();
				break;
			case 4:
				return $this->getForumId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			case 7:
				return $this->getLatestPostId();
				break;
			case 8:
				return $this->getUserId();
				break;
			case 9:
				return $this->getStrippedTitle();
				break;
			case 10:
				return $this->getIsResolved();
				break;
			case 11:
				return $this->getNbPosts();
				break;
			case 12:
				return $this->getNbViews();
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
		$keys = sfSimpleForumTopicPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getIsSticked(),
			$keys[3] => $this->getIsLocked(),
			$keys[4] => $this->getForumId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
			$keys[7] => $this->getLatestPostId(),
			$keys[8] => $this->getUserId(),
			$keys[9] => $this->getStrippedTitle(),
			$keys[10] => $this->getIsResolved(),
			$keys[11] => $this->getNbPosts(),
			$keys[12] => $this->getNbViews(),
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
		$pos = sfSimpleForumTopicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTitle($value);
				break;
			case 2:
				$this->setIsSticked($value);
				break;
			case 3:
				$this->setIsLocked($value);
				break;
			case 4:
				$this->setForumId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
			case 7:
				$this->setLatestPostId($value);
				break;
			case 8:
				$this->setUserId($value);
				break;
			case 9:
				$this->setStrippedTitle($value);
				break;
			case 10:
				$this->setIsResolved($value);
				break;
			case 11:
				$this->setNbPosts($value);
				break;
			case 12:
				$this->setNbViews($value);
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
		$keys = sfSimpleForumTopicPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsSticked($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsLocked($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setForumId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLatestPostId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUserId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setStrippedTitle($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsResolved($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setNbPosts($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setNbViews($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumTopicPeer::ID)) $criteria->add(sfSimpleForumTopicPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::TITLE)) $criteria->add(sfSimpleForumTopicPeer::TITLE, $this->title);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::IS_STICKED)) $criteria->add(sfSimpleForumTopicPeer::IS_STICKED, $this->is_sticked);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::IS_LOCKED)) $criteria->add(sfSimpleForumTopicPeer::IS_LOCKED, $this->is_locked);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::FORUM_ID)) $criteria->add(sfSimpleForumTopicPeer::FORUM_ID, $this->forum_id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::CREATED_AT)) $criteria->add(sfSimpleForumTopicPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::UPDATED_AT)) $criteria->add(sfSimpleForumTopicPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::LATEST_POST_ID)) $criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->latest_post_id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::USER_ID)) $criteria->add(sfSimpleForumTopicPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::STRIPPED_TITLE)) $criteria->add(sfSimpleForumTopicPeer::STRIPPED_TITLE, $this->stripped_title);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::IS_RESOLVED)) $criteria->add(sfSimpleForumTopicPeer::IS_RESOLVED, $this->is_resolved);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::NB_POSTS)) $criteria->add(sfSimpleForumTopicPeer::NB_POSTS, $this->nb_posts);
		if ($this->isColumnModified(sfSimpleForumTopicPeer::NB_VIEWS)) $criteria->add(sfSimpleForumTopicPeer::NB_VIEWS, $this->nb_views);

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
		$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumTopicPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of sfSimpleForumTopic (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitle($this->title);

		$copyObj->setIsSticked($this->is_sticked);

		$copyObj->setIsLocked($this->is_locked);

		$copyObj->setForumId($this->forum_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setLatestPostId($this->latest_post_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setStrippedTitle($this->stripped_title);

		$copyObj->setIsResolved($this->is_resolved);

		$copyObj->setNbPosts($this->nb_posts);

		$copyObj->setNbViews($this->nb_views);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getsfSimpleForumPosts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfSimpleForumPost($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfSimpleForumTopicViews() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfSimpleForumTopicView($relObj->copy($deepCopy));
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
	 * @return     sfSimpleForumTopic Clone of current object.
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
	 * @return     sfSimpleForumTopicPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfSimpleForumTopicPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a sfSimpleForumForum object.
	 *
	 * @param      sfSimpleForumForum $v
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfSimpleForumForum(sfSimpleForumForum $v = null)
	{
		if ($v === null) {
			$this->setForumId(NULL);
		} else {
			$this->setForumId($v->getId());
		}

		$this->asfSimpleForumForum = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfSimpleForumForum object, it will not be re-added.
		if ($v !== null) {
			$v->addsfSimpleForumTopic($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfSimpleForumForum object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfSimpleForumForum The associated sfSimpleForumForum object.
	 * @throws     PropelException
	 */
	public function getsfSimpleForumForum(PropelPDO $con = null)
	{
		if ($this->asfSimpleForumForum === null && ($this->forum_id !== null)) {
			$c = new Criteria(sfSimpleForumForumPeer::DATABASE_NAME);
			$c->add(sfSimpleForumForumPeer::ID, $this->forum_id);
			$this->asfSimpleForumForum = sfSimpleForumForumPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfSimpleForumForum->addsfSimpleForumTopics($this);
			 */
		}
		return $this->asfSimpleForumForum;
	}

	/**
	 * Declares an association between this object and a sfSimpleForumPost object.
	 *
	 * @param      sfSimpleForumPost $v
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
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
			$v->addsfSimpleForumTopic($this);
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
			   $this->asfSimpleForumPost->addsfSimpleForumTopics($this);
			 */
		}
		return $this->asfSimpleForumPost;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     sfSimpleForumTopic The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfGuardUser(sfGuardUser $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->asfGuardUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfGuardUser object, it will not be re-added.
		if ($v !== null) {
			$v->addsfSimpleForumTopic($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfGuardUser object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfGuardUser The associated sfGuardUser object.
	 * @throws     PropelException
	 */
	public function getsfGuardUser(PropelPDO $con = null)
	{
		if ($this->asfGuardUser === null && ($this->user_id !== null)) {
			$c = new Criteria(sfGuardUserPeer::DATABASE_NAME);
			$c->add(sfGuardUserPeer::ID, $this->user_id);
			$this->asfGuardUser = sfGuardUserPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfGuardUser->addsfSimpleForumTopics($this);
			 */
		}
		return $this->asfGuardUser;
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
	 * Otherwise if this sfSimpleForumTopic has previously been saved, it will retrieve
	 * related sfSimpleForumPosts from storage. If this sfSimpleForumTopic is new, it will return
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
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

				sfSimpleForumPostPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

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
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
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

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

				$count = sfSimpleForumPostPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

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
			$l->setsfSimpleForumTopic($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumTopic is new, it will return
	 * an empty collection; or if this sfSimpleForumTopic has previously
	 * been saved, it will retrieve related sfSimpleForumPosts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumTopic.
	 */
	public function getsfSimpleForumPostsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumTopic is new, it will return
	 * an empty collection; or if this sfSimpleForumTopic has previously
	 * been saved, it will retrieve related sfSimpleForumPosts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumTopic.
	 */
	public function getsfSimpleForumPostsJoinsfSimpleForumForum($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumPosts === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumPosts = array();
			} else {

				$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->id);

			if (!isset($this->lastsfSimpleForumPostCriteria) || !$this->lastsfSimpleForumPostCriteria->equals($criteria)) {
				$this->collsfSimpleForumPosts = sfSimpleForumPostPeer::doSelectJoinsfSimpleForumForum($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumPostCriteria = $criteria;

		return $this->collsfSimpleForumPosts;
	}

	/**
	 * Clears out the collsfSimpleForumTopicViews collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfSimpleForumTopicViews()
	 */
	public function clearsfSimpleForumTopicViews()
	{
		$this->collsfSimpleForumTopicViews = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfSimpleForumTopicViews collection (array).
	 *
	 * By default this just sets the collsfSimpleForumTopicViews collection to an empty array (like clearcollsfSimpleForumTopicViews());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfSimpleForumTopicViews()
	{
		$this->collsfSimpleForumTopicViews = array();
	}

	/**
	 * Gets an array of sfSimpleForumTopicView objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumTopic has previously been saved, it will retrieve
	 * related sfSimpleForumTopicViews from storage. If this sfSimpleForumTopic is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfSimpleForumTopicView[]
	 * @throws     PropelException
	 */
	public function getsfSimpleForumTopicViews($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopicViews === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumTopicViews = array();
			} else {

				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->id);

				sfSimpleForumTopicViewPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->id);

				sfSimpleForumTopicViewPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumTopicViewCriteria) || !$this->lastsfSimpleForumTopicViewCriteria->equals($criteria)) {
					$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumTopicViewCriteria = $criteria;
		return $this->collsfSimpleForumTopicViews;
	}

	/**
	 * Returns the number of related sfSimpleForumTopicView objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfSimpleForumTopicView objects.
	 * @throws     PropelException
	 */
	public function countsfSimpleForumTopicViews(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfSimpleForumTopicViews === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->id);

				$count = sfSimpleForumTopicViewPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->id);

				if (!isset($this->lastsfSimpleForumTopicViewCriteria) || !$this->lastsfSimpleForumTopicViewCriteria->equals($criteria)) {
					$count = sfSimpleForumTopicViewPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfSimpleForumTopicViews);
				}
			} else {
				$count = count($this->collsfSimpleForumTopicViews);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfSimpleForumTopicView object to this object
	 * through the sfSimpleForumTopicView foreign key attribute.
	 *
	 * @param      sfSimpleForumTopicView $l sfSimpleForumTopicView
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfSimpleForumTopicView(sfSimpleForumTopicView $l)
	{
		if ($this->collsfSimpleForumTopicViews === null) {
			$this->initsfSimpleForumTopicViews();
		}
		if (!in_array($l, $this->collsfSimpleForumTopicViews, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfSimpleForumTopicViews, $l);
			$l->setsfSimpleForumTopic($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumTopic is new, it will return
	 * an empty collection; or if this sfSimpleForumTopic has previously
	 * been saved, it will retrieve related sfSimpleForumTopicViews from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumTopic.
	 */
	public function getsfSimpleForumTopicViewsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopicViews === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopicViews = array();
			} else {

				$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->id);

				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->id);

			if (!isset($this->lastsfSimpleForumTopicViewCriteria) || !$this->lastsfSimpleForumTopicViewCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopicViews = sfSimpleForumTopicViewPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumTopicViewCriteria = $criteria;

		return $this->collsfSimpleForumTopicViews;
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
			if ($this->collsfSimpleForumPosts) {
				foreach ((array) $this->collsfSimpleForumPosts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfSimpleForumTopicViews) {
				foreach ((array) $this->collsfSimpleForumTopicViews as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collsfSimpleForumPosts = null;
		$this->collsfSimpleForumTopicViews = null;
			$this->asfSimpleForumForum = null;
			$this->asfSimpleForumPost = null;
			$this->asfGuardUser = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfSimpleForumTopic:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfSimpleForumTopic::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasesfSimpleForumTopic
