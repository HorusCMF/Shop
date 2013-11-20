var elasticsearch = require('elasticsearch'),
    config = {
        server : {
            host : 'localhost',
            port : 9200
        },
        _index : 'website_qa',
        _type : 'article'
    },
    es = elasticsearch.createClient(config);

es.search({
    query : {
        field : {
            title : 'article'
        }
    }
}, function (err, data) {
    console.log(data.hits.hits);

    // work with data here
    // response data is according to ElasticSearch spec
});
