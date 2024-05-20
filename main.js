const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
    manifestUrl: 'https://YOUR-WEBSITE/tonconnect-manifest.json',
    buttonRootId: 'ton-connect'
});

function getURLParam(paramName) {
    const params = new URLSearchParams(window.location.search);
    return params.get(paramName);
}

// Retrieve the value from GET parameters for database binding
const linkId = getURLParam('link');

tonConnectUI.setConnectRequestParameters({
    state: "ready",
    value: {
        tonProof: linkId  // Passing the attribute from GET parameters as a payload
    }
});

tonConnectUI.onStatusChange(wallet => {
    if (wallet && wallet.connectItems?.tonProof && 'proof' in wallet.connectItems.tonProof) {
        const address = new TonWeb.utils.Address(wallet.account.address);
        // toString arguments: isUserFriendly, isUrlSafe, isBounceable, isTestOnly
        // For EQ wallet: true, true, true
        // For UQ wallet: true, true, false
        const formattedAddress = address.toString(true, true, false);
        // Calling the check function with the necessary parameters and wallet address in a user-friendly format
        checkProof(wallet.connectItems.tonProof.proof, wallet.account, formattedAddress);
    }
});

async function connectToWallet() {
    await tonConnectUI.connectWallet();
}

function checkProof(proof, account, wallet) {
    // Sending data to the server
    $.post("https://YOUR-WEBSITE/back.php", { proof: proof, account: account, wallet: wallet });
}

connectToWallet();