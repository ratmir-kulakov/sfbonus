<?php

class UserTest extends CDbTestCase
{
    public $fixtures=array
    (
        'users'=>'User',
    );
    
    public function testGetTypes()
    {
        $options = User::model()->typeOptions;
        $this->assertTrue( is_array($options) );
        $this->assertTrue( 2 == count($options) );
        $this->assertTrue( in_array('Администратор', $options) );
        $this->assertTrue( in_array('Пользователь', $options) );
    }
    
    public function testGetStatuses()
    {
        $options = User::model()->statusOptions;
        $this->assertTrue( is_array($options) );
    }
    
    public function testGetStatusesCount()
    {
        $options = User::model()->statusOptions;
        $this->assertTrue( is_array($options) );
        $this->assertTrue( 2 == count($options) );
    }
    
    public function testGetStatusNames()
    {
        $options = User::model()->statusOptions;
        $this->assertTrue( is_array($options) );
        $this->assertTrue( in_array('Активен', $options) );
        $this->assertTrue( in_array('Неактивен', $options) );
    }
    
    public function testEncrypt()
    {
        $pass = User::model()->encrypt('1');
        $this->assertEquals('bczjalalreaVcrdaebfddeblaUcjDczr', $pass);
    }
    
    public function testCreate()
    {
        $newUser = new User;
        $userLastName = 'Алиев';
        $userFirstName = 'Ахмед';
        $userMiddleName = 'Алиевич';
        $userName = 'huligan';
        $newUser->setAttributes(array(
            'type' => 0,
            'last_name' => $userLastName,
            'first_name' => $userFirstName,
            'middle_name' => $userMiddleName,
            'username' => $userName,
            'password' => '123',
            'status' => 1,
        ));
        $this->assertTrue( $newUser->save(false) );
        $retrievedUser = User::model()->findByPk( $newUser->id );
        $this->assertTrue( $retrievedUser instanceof User );
        $this->assertEquals( $userLastName, $retrievedUser->last_name );
        $this->assertEquals( $userFirstName, $retrievedUser->first_name );
        $this->assertEquals( $userMiddleName, $retrievedUser->middle_name );
        $this->assertEquals( $userName, $retrievedUser->username );
    }
    
    public function testRead()
    {
        $retrievedUser = $this->users('user1');
        $this->assertTrue( $retrievedUser instanceof User );
        $this->assertEquals( 'Магомедов', $retrievedUser->last_name );
    }
    
    public function testUpdate()
    {
        $user = $this->users('user2');
        $userLastName = 'Алиев';
        $userFirstName = 'Магомед';
        $userMiddleName = 'Алиевич';
        $userName = 'huligan05';
        $user->last_name = $userLastName;
        $user->first_name = $userFirstName;
        $user->middle_name = $userMiddleName;
        $user->username = $userName;
        $this->assertTrue( $user->save(false) );
        $updatedUser = User::model()->findByPk( $user->id );
        $this->assertTrue( $updatedUser instanceof User );
        $this->assertEquals( $userLastName, $updatedUser->last_name );
        $this->assertEquals( $userFirstName, $updatedUser->first_name );
        $this->assertEquals( $userMiddleName, $updatedUser->middle_name );
        $this->assertEquals( $userName, $updatedUser->username );
    }

    public function testDelete()
    {
        $user = $this->users('user2');
        $savedUserId = $user->id;
        $this->assertTrue( $user->delete() );
        $deletedUser=User::model()->findByPk( $savedUserId );
        $this->assertEquals( NULL, $deletedUser );
    }
}

?>
