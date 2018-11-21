<?php

return [
    'alipay' => [
        'app_id'         => '2016080800193590',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAybCUMfg4fF9TGF43+F+2dlp70ykkbokF1G0pnBplDDalHv1H9XqXFKiVAUBkZwrODOG5z181Ij+GRjKfpxi187EO94+SAYTUM7Vnt0FCQWB+oSxvu2dFtdS08dt+NsqWvyy18/goE0rF5qg5Jp7p1waO8Fdml/LyMMBO9u2+1xRzmReQZWCiPSoRovkoubN8F5yvsfTpG1mEsZdHMfPFDdrkfx4k/1oSdkPMCuSqfpQg3UYZJQutgifaccF9ceAgpOl4+J5duFxg8fwZIBSE1sxu3tNkqNaeXsmuBwb1DqDuR+Pi2BIHJl/2iPAILf7NR75QWKsRus/fTMj6IgsbPwIDAQAB',
        'private_key'    => 'MIIEogIBAAKCAQEAqrs+yimzy8hWZ3vvq4Ee/yhI3ly89GOch39mkb9mWX6UrqZTlZynRhJhn8B6/Smbq1gGM2FW54A5eCqjj5cokcZeoFRAFPehkf/ZTi3KU7c4lGiUy+6NRwS87EtWr/0Wi0j4KaOs3Ut/q7aY0k8ehuFLU+5aWdaZ3OflCffXexfZYt9RDJmlYSD4O7P/HI2Krl+HH/f5ALik5XS1m5V13aOzqLd6aFZrhwXjjZDSUD5qdQTuSGmyuzpY571v18uaVV9OUTqIPUwFnhKocpwLNzaMZfiQqJR5MZDV+h+OkRyh9TSI/eVbtZ+XYtKKAtxRswF7ozP9fEo5hJ/0jF1OUQIDAQABAoIBAAPrsuBvnrpiSmGr/fABUhXn9extUsWF+BVAfrmAHLiXaJCuLyMzar/4Mhe6Etj3eKSxq8rIRHeigS9aQ1FL1lmqpYenB6Wznhk9N99Mu+W6QmleEXSxcLsdx7zhagc2l6rxLQm/wXt/fVoTImVJ/dh5GgK+aYLAo93n0WGuOFuSQgh5hhIFIuJw5j8igMDhtM/10yXsryc/b5qtQcilNr11cc5vSy+3tR7f+nS3Fg0jNCiGW2ecMazOYen9/PPQ7BzzhfpzOIekioQfj2++FMHcZceO1WNez6sMrEojUer8fh49tvCAZM5IVND4T5jLE3vnDGOxE5URHQGaAPgtevECgYEA002K6K0GyvLSwEhynWFexzq6yCF+3bWmLX0Tu9JCNQZijAeac0Obkjh+C5V1x50/FYWWa00WINcGpRh4blHDT5Abt3k7PA5EaElUfesDJas5S6rh5raTAVa66g/XxaYpaN1nDnFRqAZdIh+ES4jda6lQ+pQCfTg9y3cZMwQp4q0CgYEAztit9R+UvZX5u25zPW89cbDFYwNDrpxzG7Rv3byRcbcTAz+hFvX4c9QKw5v9UGbrYTqHMCYW90VRsAD0jujhsQWfoAicpKijkaa3xvhJCO/7RddkEYBYYe+HnjY2FcAva6hqczK1KMSrOP8S8/SF6RpwU6/buWUZg9/EkzvrcrUCgYBN4UewiI13YdZRrqIn5YqETd4oA0h6OQhdvbr3QADNAGR0Dh1cHHALjazPYi/9+bQVn54YQFpGklpNoV5J8vLUsV212wX9FZkbAuQUYPlQ+fHtNLd8TJCULr5HpL03iQ28K9ZfGV8qWeYbvJgLKw/JLae+I61jL8Z+5o+wIPm7JQKBgBtRFFAt9oe/Gbb+FCwF19h+3uJ/mN2jfbQn9SoUcCTTZ6hjK9QLcd9iHnXM0PxgSy+Q+i+KqDfJqMsUpTeGW9/z/Su2V3GLb+aZXOXi/ko23zlPA8En8QQmDQQA5s2ijuCp4j0KclBLAM3LKeab4V9yhWkX7W2jg2YeFCjZnfONAoGAagMPqTt/N4+YlqJSx3B6Dl+wSZooa9D7ppkAx2NX2ac6MDhz7A77/1hytZyR/bXC5Rdl5D+q80fnMvz602gTrirQJG5VRfQCA5gLfb+tK8q6qsjji2ZA1NCKbnT9H0hvpHkTbZg6+04t9WLCqaY7O5pMe6emWm7jAPsCroQJORU=',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];