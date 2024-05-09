public class fakemail {
	public static void main(String[] args) {
		System.out.println("Total parameters: " + args.length);
		
		if (args.length == 1) {
			System.out.println("Error: Only 1 parameter!!\n");
		}
		
		
		
		if (args.length != 4) {
			System.out.println("Invalid number of parameters!!\n\n");
		} else {
		  System.out.printf ("This is the fakemail system, this email will NOT be delivered\n");
  		System.out.printf ("and is intended for testing purposes ONLY!\n\n");
  		System.out.printf ("The email that would have been sent is...\n\n");
    	System.out.printf ("Sent From: %s\n", args[0]);
  		System.out.printf ("Sent To: %s\n", args[1]);
  		System.out.printf ("Subject: %s\n", args[2]);
  		System.out.printf ("Message: %s\n", args[3]);
		}
	}
	
}

