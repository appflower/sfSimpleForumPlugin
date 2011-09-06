<?php

/**
 * Base class that represents a row from the 'sf_simple_forum_post' table.
 *
 * 
 *
 * @package    plugins.sfSimpleForumPlugin.lib.model.om
 */
abstract class BasesfSimpleForumPost extends BaseObject  implements Persistent {


  const PEER = 'sfSimpleForumPostPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        sfSimpleForumPostPeer
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
	 * The value for the content field.
	 * @var        string
	 */
	protected $content;

	/**
	 * The value for the topic_id field.
	 * @var        int
	 */
	protected $topic_id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the forum_id field.
	 * @var        int
	 */
	protected $forum_id;

	/**
	 * The value for the author_name field.
	 * @var        string
	 */
	protected $author_name;

	/**
	 * The value for the author_email field.
	 * @var        string
	 */
	protected $author_email;

	/**
	 * @var        sfSimpleForumTopic
	 */
	protected $asfSimpleForumTopic;

	/**
	 * @var        sfGuardUser
	 */
	protected $asfGuardUser;

	/**
	 * @var        sfSimpleForumForum
	 */
	protected $asfSimpleForumForum;

	/**
	 * @var        array sfSimpleForumForum[] Collection to store aggregation of sfSimpleForumForum objects.
	 */
	protected $collsfSimpleForumForums;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfSimpleForumForums.
	 */
	private $lastsfSimpleForumForumCriteria = null;

	/**
	 * @var        array sfSimpleForumTopic[] Collection to store aggregation of sfSimpleForumTopic objects.
	 */
	protected $collsfSimpleForumTopics;

	/**
	 * @var        Criteria The criteria used to select the current contents of collsfSimpleForumTopics.
	 */
	private $lastsfSimpleForumTopicCriteria = null;

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
	 * Initializes internal state of BasesfSimpleForumPost object.
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
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [content] column value.
	 * 
	 * @return     string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Get the [topic_id] column value.
	 * 
	 * @return     int
	 */
	public function getTopicId()
	{
		return $this->topic_id;
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
	 * Get the [forum_id] column value.
	 * 
	 * @return     int
	 */
	public function getForumId()
	{
		return $this->forum_id;
	}

	/**
	 * Get the [author_name] column value.
	 * 
	 * @return     string
	 */
	public function getAuthorName()
	{
		return $this->author_name;
	}

	/**
	 * Get the [author_email] column value.
	 * 
	 * @return     string
	 */
	public function getAuthorEmail()
	{
		return $this->author_email;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [content] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->content !== $v) {
			$this->content = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::CONTENT;
		}

		return $this;
	} // setContent()

	/**
	 * Set the value of [topic_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setTopicId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->topic_id !== $v) {
			$this->topic_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::TOPIC_ID;
		}

		if ($this->asfSimpleForumTopic !== null && $this->asfSimpleForumTopic->getId() !== $v) {
			$this->asfSimpleForumTopic = null;
		}

		return $this;
	} // setTopicId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::USER_ID;
		}

		if ($this->asfGuardUser !== null && $this->asfGuardUser->getId() !== $v) {
			$this->asfGuardUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     sfSimpleForumPost The current object (for fluent API support)
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
				$this->modifiedColumns[] = sfSimpleForumPostPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Set the value of [forum_id] column.
	 * 
	 * @param      int $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setForumId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->forum_id !== $v) {
			$this->forum_id = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::FORUM_ID;
		}

		if ($this->asfSimpleForumForum !== null && $this->asfSimpleForumForum->getId() !== $v) {
			$this->asfSimpleForumForum = null;
		}

		return $this;
	} // setForumId()

	/**
	 * Set the value of [author_name] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setAuthorName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->author_name !== $v) {
			$this->author_name = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::AUTHOR_NAME;
		}

		return $this;
	} // setAuthorName()

	/**
	 * Set the value of [author_email] column.
	 * 
	 * @param      string $v new value
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 */
	public function setAuthorEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->author_email !== $v) {
			$this->author_email = $v;
			$this->modifiedColumns[] = sfSimpleForumPostPeer::AUTHOR_EMAIL;
		}

		return $this;
	} // setAuthorEmail()

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
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->content = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->topic_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->user_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->created_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->forum_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->author_name = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->author_email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = sfSimpleForumPostPeer::NUM_COLUMNS - sfSimpleForumPostPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating sfSimpleForumPost object", $e);
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

		if ($this->asfSimpleForumTopic !== null && $this->topic_id !== $this->asfSimpleForumTopic->getId()) {
			$this->asfSimpleForumTopic = null;
		}
		if ($this->asfGuardUser !== null && $this->user_id !== $this->asfGuardUser->getId()) {
			$this->asfGuardUser = null;
		}
		if ($this->asfSimpleForumForum !== null && $this->forum_id !== $this->asfSimpleForumForum->getId()) {
			$this->asfSimpleForumForum = null;
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
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = sfSimpleForumPostPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->asfSimpleForumTopic = null;
			$this->asfGuardUser = null;
			$this->asfSimpleForumForum = null;
			$this->collsfSimpleForumForums = null;
			$this->lastsfSimpleForumForumCriteria = null;

			$this->collsfSimpleForumTopics = null;
			$this->lastsfSimpleForumTopicCriteria = null;

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

    foreach (sfMixer::getCallables('BasesfSimpleForumPost:delete:pre') as $callable)
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
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			sfSimpleForumPostPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasesfSimpleForumPost:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasesfSimpleForumPost:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(sfSimpleForumPostPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(sfSimpleForumPostPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasesfSimpleForumPost:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			sfSimpleForumPostPeer::addInstanceToPool($this);
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

			if ($this->asfSimpleForumTopic !== null) {
				if ($this->asfSimpleForumTopic->isModified() || $this->asfSimpleForumTopic->isNew()) {
					$affectedRows += $this->asfSimpleForumTopic->save($con);
				}
				$this->setsfSimpleForumTopic($this->asfSimpleForumTopic);
			}

			if ($this->asfGuardUser !== null) {
				if ($this->asfGuardUser->isModified() || $this->asfGuardUser->isNew()) {
					$affectedRows += $this->asfGuardUser->save($con);
				}
				$this->setsfGuardUser($this->asfGuardUser);
			}

			if ($this->asfSimpleForumForum !== null) {
				if ($this->asfSimpleForumForum->isModified() || $this->asfSimpleForumForum->isNew()) {
					$affectedRows += $this->asfSimpleForumForum->save($con);
				}
				$this->setsfSimpleForumForum($this->asfSimpleForumForum);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = sfSimpleForumPostPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = sfSimpleForumPostPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += sfSimpleForumPostPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collsfSimpleForumForums !== null) {
				foreach ($this->collsfSimpleForumForums as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsfSimpleForumTopics !== null) {
				foreach ($this->collsfSimpleForumTopics as $referrerFK) {
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

			if ($this->asfSimpleForumTopic !== null) {
				if (!$this->asfSimpleForumTopic->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumTopic->getValidationFailures());
				}
			}

			if ($this->asfGuardUser !== null) {
				if (!$this->asfGuardUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfGuardUser->getValidationFailures());
				}
			}

			if ($this->asfSimpleForumForum !== null) {
				if (!$this->asfSimpleForumForum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->asfSimpleForumForum->getValidationFailures());
				}
			}


			if (($retval = sfSimpleForumPostPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collsfSimpleForumForums !== null) {
					foreach ($this->collsfSimpleForumForums as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsfSimpleForumTopics !== null) {
					foreach ($this->collsfSimpleForumTopics as $referrerFK) {
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
		$pos = sfSimpleForumPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getContent();
				break;
			case 3:
				return $this->getTopicId();
				break;
			case 4:
				return $this->getUserId();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getForumId();
				break;
			case 7:
				return $this->getAuthorName();
				break;
			case 8:
				return $this->getAuthorEmail();
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
		$keys = sfSimpleForumPostPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getContent(),
			$keys[3] => $this->getTopicId(),
			$keys[4] => $this->getUserId(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getForumId(),
			$keys[7] => $this->getAuthorName(),
			$keys[8] => $this->getAuthorEmail(),
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
		$pos = sfSimpleForumPostPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setContent($value);
				break;
			case 3:
				$this->setTopicId($value);
				break;
			case 4:
				$this->setUserId($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setForumId($value);
				break;
			case 7:
				$this->setAuthorName($value);
				break;
			case 8:
				$this->setAuthorEmail($value);
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
		$keys = sfSimpleForumPostPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTopicId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setForumId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAuthorName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAuthorEmail($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);

		if ($this->isColumnModified(sfSimpleForumPostPeer::ID)) $criteria->add(sfSimpleForumPostPeer::ID, $this->id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::TITLE)) $criteria->add(sfSimpleForumPostPeer::TITLE, $this->title);
		if ($this->isColumnModified(sfSimpleForumPostPeer::CONTENT)) $criteria->add(sfSimpleForumPostPeer::CONTENT, $this->content);
		if ($this->isColumnModified(sfSimpleForumPostPeer::TOPIC_ID)) $criteria->add(sfSimpleForumPostPeer::TOPIC_ID, $this->topic_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::USER_ID)) $criteria->add(sfSimpleForumPostPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::CREATED_AT)) $criteria->add(sfSimpleForumPostPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(sfSimpleForumPostPeer::FORUM_ID)) $criteria->add(sfSimpleForumPostPeer::FORUM_ID, $this->forum_id);
		if ($this->isColumnModified(sfSimpleForumPostPeer::AUTHOR_NAME)) $criteria->add(sfSimpleForumPostPeer::AUTHOR_NAME, $this->author_name);
		if ($this->isColumnModified(sfSimpleForumPostPeer::AUTHOR_EMAIL)) $criteria->add(sfSimpleForumPostPeer::AUTHOR_EMAIL, $this->author_email);

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
		$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);

		$criteria->add(sfSimpleForumPostPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of sfSimpleForumPost (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTitle($this->title);

		$copyObj->setContent($this->content);

		$copyObj->setTopicId($this->topic_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setForumId($this->forum_id);

		$copyObj->setAuthorName($this->author_name);

		$copyObj->setAuthorEmail($this->author_email);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getsfSimpleForumForums() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfSimpleForumForum($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getsfSimpleForumTopics() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addsfSimpleForumTopic($relObj->copy($deepCopy));
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
	 * @return     sfSimpleForumPost Clone of current object.
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
	 * @return     sfSimpleForumPostPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new sfSimpleForumPostPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a sfSimpleForumTopic object.
	 *
	 * @param      sfSimpleForumTopic $v
	 * @return     sfSimpleForumPost The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setsfSimpleForumTopic(sfSimpleForumTopic $v = null)
	{
		if ($v === null) {
			$this->setTopicId(NULL);
		} else {
			$this->setTopicId($v->getId());
		}

		$this->asfSimpleForumTopic = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the sfSimpleForumTopic object, it will not be re-added.
		if ($v !== null) {
			$v->addsfSimpleForumPost($this);
		}

		return $this;
	}


	/**
	 * Get the associated sfSimpleForumTopic object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     sfSimpleForumTopic The associated sfSimpleForumTopic object.
	 * @throws     PropelException
	 */
	public function getsfSimpleForumTopic(PropelPDO $con = null)
	{
		if ($this->asfSimpleForumTopic === null && ($this->topic_id !== null)) {
			$c = new Criteria(sfSimpleForumTopicPeer::DATABASE_NAME);
			$c->add(sfSimpleForumTopicPeer::ID, $this->topic_id);
			$this->asfSimpleForumTopic = sfSimpleForumTopicPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->asfSimpleForumTopic->addsfSimpleForumPosts($this);
			 */
		}
		return $this->asfSimpleForumTopic;
	}

	/**
	 * Declares an association between this object and a sfGuardUser object.
	 *
	 * @param      sfGuardUser $v
	 * @return     sfSimpleForumPost The current object (for fluent API support)
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
			$v->addsfSimpleForumPost($this);
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
			   $this->asfGuardUser->addsfSimpleForumPosts($this);
			 */
		}
		return $this->asfGuardUser;
	}

	/**
	 * Declares an association between this object and a sfSimpleForumForum object.
	 *
	 * @param      sfSimpleForumForum $v
	 * @return     sfSimpleForumPost The current object (for fluent API support)
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
			$v->addsfSimpleForumPost($this);
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
			   $this->asfSimpleForumForum->addsfSimpleForumPosts($this);
			 */
		}
		return $this->asfSimpleForumForum;
	}

	/**
	 * Clears out the collsfSimpleForumForums collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addsfSimpleForumForums()
	 */
	public function clearsfSimpleForumForums()
	{
		$this->collsfSimpleForumForums = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collsfSimpleForumForums collection (array).
	 *
	 * By default this just sets the collsfSimpleForumForums collection to an empty array (like clearcollsfSimpleForumForums());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initsfSimpleForumForums()
	{
		$this->collsfSimpleForumForums = array();
	}

	/**
	 * Gets an array of sfSimpleForumForum objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumPost has previously been saved, it will retrieve
	 * related sfSimpleForumForums from storage. If this sfSimpleForumPost is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array sfSimpleForumForum[]
	 * @throws     PropelException
	 */
	public function getsfSimpleForumForums($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumForums === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumForums = array();
			} else {

				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->id);

				sfSimpleForumForumPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->id);

				sfSimpleForumForumPeer::addSelectColumns($criteria);
				if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
					$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsfSimpleForumForumCriteria = $criteria;
		return $this->collsfSimpleForumForums;
	}

	/**
	 * Returns the number of related sfSimpleForumForum objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related sfSimpleForumForum objects.
	 * @throws     PropelException
	 */
	public function countsfSimpleForumForums(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collsfSimpleForumForums === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->id);

				$count = sfSimpleForumForumPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->id);

				if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
					$count = sfSimpleForumForumPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collsfSimpleForumForums);
				}
			} else {
				$count = count($this->collsfSimpleForumForums);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a sfSimpleForumForum object to this object
	 * through the sfSimpleForumForum foreign key attribute.
	 *
	 * @param      sfSimpleForumForum $l sfSimpleForumForum
	 * @return     void
	 * @throws     PropelException
	 */
	public function addsfSimpleForumForum(sfSimpleForumForum $l)
	{
		if ($this->collsfSimpleForumForums === null) {
			$this->initsfSimpleForumForums();
		}
		if (!in_array($l, $this->collsfSimpleForumForums, true)) { // only add it if the **same** object is not already associated
			array_push($this->collsfSimpleForumForums, $l);
			$l->setsfSimpleForumPost($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumPost is new, it will return
	 * an empty collection; or if this sfSimpleForumPost has previously
	 * been saved, it will retrieve related sfSimpleForumForums from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumPost.
	 */
	public function getsfSimpleForumForumsJoinsfSimpleForumCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumForums === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumForums = array();
			} else {

				$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->id);

				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumCategory($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumForumPeer::LATEST_POST_ID, $this->id);

			if (!isset($this->lastsfSimpleForumForumCriteria) || !$this->lastsfSimpleForumForumCriteria->equals($criteria)) {
				$this->collsfSimpleForumForums = sfSimpleForumForumPeer::doSelectJoinsfSimpleForumCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumForumCriteria = $criteria;

		return $this->collsfSimpleForumForums;
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
	 * Otherwise if this sfSimpleForumPost has previously been saved, it will retrieve
	 * related sfSimpleForumTopics from storage. If this sfSimpleForumPost is new, it will return
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
			$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
			   $this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

				sfSimpleForumTopicPeer::addSelectColumns($criteria);
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

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
			$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
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

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

				$count = sfSimpleForumTopicPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

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
			$l->setsfSimpleForumPost($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumPost is new, it will return
	 * an empty collection; or if this sfSimpleForumPost has previously
	 * been saved, it will retrieve related sfSimpleForumTopics from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumPost.
	 */
	public function getsfSimpleForumTopicsJoinsfSimpleForumForum($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumForum($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfSimpleForumForum($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this sfSimpleForumPost is new, it will return
	 * an empty collection; or if this sfSimpleForumPost has previously
	 * been saved, it will retrieve related sfSimpleForumTopics from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in sfSimpleForumPost.
	 */
	public function getsfSimpleForumTopicsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(sfSimpleForumPostPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsfSimpleForumTopics === null) {
			if ($this->isNew()) {
				$this->collsfSimpleForumTopics = array();
			} else {

				$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(sfSimpleForumTopicPeer::LATEST_POST_ID, $this->id);

			if (!isset($this->lastsfSimpleForumTopicCriteria) || !$this->lastsfSimpleForumTopicCriteria->equals($criteria)) {
				$this->collsfSimpleForumTopics = sfSimpleForumTopicPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastsfSimpleForumTopicCriteria = $criteria;

		return $this->collsfSimpleForumTopics;
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
			if ($this->collsfSimpleForumForums) {
				foreach ((array) $this->collsfSimpleForumForums as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collsfSimpleForumTopics) {
				foreach ((array) $this->collsfSimpleForumTopics as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collsfSimpleForumForums = null;
		$this->collsfSimpleForumTopics = null;
			$this->asfSimpleForumTopic = null;
			$this->asfGuardUser = null;
			$this->asfSimpleForumForum = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasesfSimpleForumPost:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasesfSimpleForumPost::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasesfSimpleForumPost
