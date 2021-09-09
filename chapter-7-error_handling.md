# Error Handling

- Use Exceptions Rather Than Return Codes

- Provide Context with Exceptions
    - Create informative error messages and pass them along with your exceptions. Mention the operation that failed and the type of failure. If you are logging in your application, pass along enough information to be able to log the error in your catch.

- Define Exception Classes in Terms of a Caller’s Needs

- In this case, because we know that the work that we are doing is roughly the same regardless of the exception, we can simplify our code considerably by wrapping the API that we are calling and making sure that it returns a common exception type:    

    ```java
    LocalPort port = new LocalPort(12);    
    try {      
        port.open();    
    } catch (PortDeviceFailure e) {      
        reportError(e);      
        logger.log(e.getMessage(), e);    
    } finally {      
        …    
    }
    ```

- Our LocalPort class is just a simple wrapper that catches and translates exceptions thrown by the ACMEPort class:  
  
    ```java
    public class LocalPort {      
        private ACMEPort innerPort;      
        
        public LocalPort(int portNumber) {        
            innerPort = new ACMEPort(portNumber);      
        }      
        
        public void open() {        
            try {          
                innerPort.open();        
            } catch (DeviceResponseException e) {          
                throw new PortDeviceFailure(e);        
            } catch (ATM1212UnlockedException e) {          
                throw new PortDeviceFailure(e);        
            } catch (GMXError e) {
                throw new PortDeviceFailure(e);        
            }      
        }      
        
        …    
    }
    ```

- Wrappers like the one we defined for ACMEPort can be very useful. In fact, wrapping third-party APIs is a best practice.
    - When you wrap a third-party API, you minimize your dependencies upon it:
    - You can choose to move to a different library in the future without much penalty. Wrapping also makes it easier to mock out third-party calls when you are testing your own code.

- SPECIAL CASE PATTERN [Fowler]. You create a class or configure an object so that it handles a special case for you.

- Don’t Return Null

- Don’t Pass Null