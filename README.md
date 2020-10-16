# Simple BestBuy API for PHP

This is a simple high-level PHP client for the [Best Buy developer API](https://developer.bestbuy.com/).

# Quickstart 

<img src="https://carbon.now.sh/?bg=rgba(171%2C%20184%2C%20195%2C%201)&t=seti&wt=none&l=auto&ds=true&dsyoff=20px&dsblur=68px&wc=true&wa=true&pv=56px&ph=56px&ln=false&fl=1&fm=Hack&fs=14px&lh=133%25&si=false&es=2x&wm=false&code=const%2520pluckDeep%2520%253D%2520key%2520%253D%253E%2520obj%2520%253D%253E%2520key.split(%27.%27).reduce((accum%252C%2520key)%2520%253D%253E%2520accum%255Bkey%255D%252C%2520obj)%250Aasdsad%250Aconst%2520compose%2520%253D%2520(...fns)%2520%253D%253E%2520res%2520%253D%253E%2520fns.reduce((accum%252C%2520next)%2520%253D%253E%2520next(accum)%252C%2520res)%250A%250Aconst%2520unfold%2520%253D%2520(f%252C%2520seed)%2520%253D%253E%2520%257B%250A%2520%2520const%2520go%2520%253D%2520(f%252C%2520seed%252C%2520acc)%2520%253D%253E%2520%257B%250A%2520%2520%2520%2520const%2520res%2520%253D%2520f(seed)%250A%2520%2520%2520%2520return%2520res%2520%253F%2520go(f%252C%2520res%255B1%255D%252C%2520acc.concat(%255Bres%255B0%255D%255D))%2520%253A%2520acc%250A%2520%2520%257D%250A%2520%2520return%2520go(f%252C%2520seed%252C%2520%255B%255D)%250A%257D" align="right"
     alt="Example usage of code" height="200", width="200">