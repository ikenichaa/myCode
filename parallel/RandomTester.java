import java.util.Random; 

public class RandomTester {
	private static final int NUM_RANDOMS = 100000000;
	public static void main(String[] args) throws Exception { 
		long st = System.currentTimeMillis();
		int count = 0;
		Random random = new Random();
		for (int i=0; i < NUM_RANDOMS; i++) { 
			double rnd = random.nextDouble(); if (rnd < 0.5)
				count++;
		}
		long et = System.currentTimeMillis(); 
		System.out.println(((double) count)/NUM_RANDOMS + "%"); 
		System.out.println("Execution time: " + (et-st) + " ms.");
	} 
}