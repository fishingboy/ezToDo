<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_blog extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'todoID'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ],
            'userID'       => ['type' => 'INT', 'constraint' => 11],
            'status'       => ['type' => 'INT', 'constraint' => 11],
            'title'        => ['type' => 'VARCHAR', 'constraint' => 11],
            'note'         => ['type' => 'TEXT'],
            'hours'        => ['type' => 'FLOAT'],
            'usedHours'    => ['type' => 'FLOAT'],
            'createTime'   => ['type' => 'DATETIME'],
            'updateTime'   => ['type' => 'DATETIME'],
            'completeTime' => ['type' => 'DATETIME'],
            'sn'           => ['type' => 'INT', 'constraint' => 11],
        ]);
        $this->dbforge->add_key('todoID', TRUE);
        $this->dbforge->create_table('todo123');
    }

    public function down()
    {
        $this->dbforge->drop_table('todo123');
    }
}
/* End of file 001_add_blog.php */
/* Location: ./application/migrations/001_add_blog.php */