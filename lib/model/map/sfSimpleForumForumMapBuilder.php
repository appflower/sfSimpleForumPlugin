<?php


/**
 * This class adds structure of 'sf_simple_forum_forum' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    plugins.sfSimpleForumPlugin.lib.model.map
 */
class sfSimpleForumForumMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'plugins.sfSimpleForumPlugin.lib.model.map.sfSimpleForumForumMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(sfSimpleForumForumPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(sfSimpleForumForumPeer::TABLE_NAME);
		$tMap->setPhpName('sfSimpleForumForum');
		$tMap->setClassname('sfSimpleForumForum');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('RANK', 'Rank', 'INTEGER', false, null);

		$tMap->addForeignKey('CATEGORY_ID', 'CategoryId', 'INTEGER', 'sf_simple_forum_category', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('STRIPPED_NAME', 'StrippedName', 'VARCHAR', false, 255);

		$tMap->addForeignKey('LATEST_POST_ID', 'LatestPostId', 'INTEGER', 'sf_simple_forum_post', 'ID', false, null);

		$tMap->addColumn('NB_POSTS', 'NbPosts', 'INTEGER', false, null);

		$tMap->addColumn('NB_TOPICS', 'NbTopics', 'INTEGER', false, null);

	} // doBuild()

} // sfSimpleForumForumMapBuilder
