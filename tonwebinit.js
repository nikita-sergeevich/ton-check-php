document.addEventListener("DOMContentLoaded", function () {
    // get the decentralized RPC endpoint
    TonAccess.getHttpEndpoint().then((endpoint) => { 
        // initialize tonweb library
        const tonweb = new TonWeb(new TonWeb.HttpProvider(endpoint)); 
    });
});