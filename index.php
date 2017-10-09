<?php
require 'vendor/predis/predis/autoload.php';

try {
    $redis = new Predis\Client();

}
catch (Exception $e) {
    die($e->getMessage());
}

/**
 Let's try it out!!!!!!!!
 */

/**
 * GETTER AND SETTER
 */
$redis->set('message','hello world');

//Get value of a key
echo $redis->get('message');
echo '<br>';


//Check if a key exist
echo ($redis->exists('message')) ? "Yes message exists" : "please populate the message key";
echo '<br>';


/**
 * INCREMENT AND DECREMENT
 */
$redis->set("counter", 0);
//Increase counter by 1
$redis->incr("counter"); // 1
$redis->incr("counter"); // 2

//Decrease counter
$redis->decr("counter"); // 1

//Increase counter by 15 and 5
$redis->incrby("counter", 15); // 16
$redis->incrby("counter", 5);  // 21
print_r($redis->get("counter"));
echo '<br>';


//Decrease counter by 10
$redis->decrby("counter", 10); // 11
print_r($redis->get("counter"));
echo '<br>';



/**
 * LISTS
 */
$redis->
$redis->rpush("languages", "french"); // [french]
$redis->rpush("languages", "arabic"); // [french, arabic]

$redis->lpush("languages", "english"); // [english, french, arabic]
$redis->lpush("languages", "swedish"); // [swedish, english, french, arabic]

$redis->lpop("languages"); // [english, french, arabic]
$redis->rpop("languages"); // [english, french]

$redis->llen("languages"); // 2

print_r($redis->lrange("languages", 0, -1)); // returns all elements
echo '<br>';
print_r($redis->lrange("languages", 0, 1)); // [english, french]



/**
HASHES
 */
$key = 'linus torvalds';;
$redis->hset($key, 'age', 44);
$redis->hset($key, 'country', 'finland');
$redis->hset($key, 'occupation', 'software engineer');
$redis->hset($key, 'reknown', 'linux kernel');
$redis->hset($key, 'to delete', 'i will be deleted');

$redis->get($key, 'age'); // 44
$redis->get($key, 'country'); // Finland

$redis->del($key, 'to delete');

$redis->hincrby($key, 'age', 20); // 64

$redis->hmset($key, [
    'age' => 44,
    'country' => 'finland',
    'occupation' => 'software engineer',
    'reknown' => 'linux kernel',
]);

// finally
$data = $redis->hgetall($key);
print_r($data); // returns all key-value that belongs to the hash

//    [
//        'age' => 44,
//        'country' => 'finland',
//        'occupation' => 'software engineer',
//        'reknown' => 'linux kernel',
//    ]


/**
 SETS
 */
$key = "countries";
$redis->sadd($key, 'china');
$redis->sadd($key, ['england', 'france', 'germany']);
$redis->sadd($key, 'china'); // this entry is ignored

$redis->srem($key, ['england', 'china']);

$redis->sismember($key, 'england'); // false

print_r($redis->smembers($key)); // ['france', 'germany']


/**
 * EXPIRY AND PERSISTENCE
 */
$key = "expire in 1 hour";
$redis->expire($key, 3600); // expires in 1 hour
$redis->expireat($key, time() + 3600); // expires in 1 hour

sleep(600); // don't try this, just an illustration for time spent

$redis->ttl($key); // 3000, ergo expires in 50 minutes

$redis->persist($key); // this will never expire.