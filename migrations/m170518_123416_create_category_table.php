<?php

class m170518_123416_create_category_table extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('filemanager_category', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addColumn('filemanager_mediafile', 'category_id', $this->integer());

        $this->addForeignKey('fk_filemanager_mediafile_category_id', 'filemanager_mediafile', 'category_id', 'filemanager_category', 'id', 'set null');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_filemanager_mediafile_category_id', 'filemanager_mediafile');
        $this->dropColumn('filemanager_mediafile', 'category_id');
        $this->dropTable('filemanager_category');
    }
}
