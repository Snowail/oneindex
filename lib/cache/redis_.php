<?php
class redis_{
        private $redis;

        function __construct($config = null){
                $this->redis = new Redis();
                if(empty($config)){
<<<<<<< HEAD
                        $config = 'pc5e1edd5839cc313befe434abd0844b1beaa733512f65d5ad956bd449ee573a1@ec2-54-226-76-107.compute-1.amazonaws.com:10689';
=======
                        $config = 'localhost:6379';
>>>>>>> parent of 21ffba1 (update redis)
                }
                list($host, $port) = explode(':', $config, 2);
                $this->redis->pconnect($host, $port);
        }

        function get($key){
                $gRefreshTime = $this->redis->get("OneIndex_gRefreshTime");
                $key = "OneIndex_$gRefreshTime\_" . $key;
                $data = $this->redis->get($key);
                return unserialize($data) ?: null;
        }

        function set($key, $value=null, $expire=600){
                $gRefreshTime = $this->redis->get("OneIndex_gRefreshTime");
                if (empty($gRefreshTime)) {
                        $gRefreshTime = time();
                        $this->redis->set("OneIndex_gRefreshTime", $gRefreshTime);
                }
                $key = "OneIndex_$gRefreshTime\_" . $key;
                return $this->redis->set($key, serialize($value), $expire);
        }

        function clear(){
                $this->redis->set("OneIndex_gRefreshTime", $gRefreshTime);
        }
}
